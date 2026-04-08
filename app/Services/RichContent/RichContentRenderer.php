<?php

namespace App\Services\RichContent;

use DOMDocument;
use DOMElement;
use DOMXPath;

class RichContentRenderer
{
    public function render(?string $html): string
    {
        $html = trim((string) $html);

        if ($html === '') {
            return '';
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        $previousUseInternalErrors = libxml_use_internal_errors(true);

        $rootId = 'cadde-rich-content-root';
        $wrappedHtml = '<div id="' . $rootId . '">' . $html . '</div>';

        $dom->loadHTML(
            mb_convert_encoding($wrappedHtml, 'HTML-ENTITIES', 'UTF-8'),
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );

        libxml_clear_errors();
        libxml_use_internal_errors($previousUseInternalErrors);

        $xpath = new DOMXPath($dom);
        $root = $xpath->query('//*[@id="' . $rootId . '"]')->item(0);

        if (! $root instanceof DOMElement) {
            return $html;
        }

        /** @var \DOMElement $figure */
        foreach ($xpath->query('.//figure', $root) as $figure) {
            $this->normalizeFigure($figure);
        }

        return $this->innerHtml($root);
    }

    private function normalizeFigure(DOMElement $figure): void
    {
        $classes = preg_split('/\s+/', trim((string) $figure->getAttribute('class'))) ?: [];
        $classes = array_values(array_filter($classes));

        $isAttachment = in_array('attachment', $classes, true) || $figure->hasAttribute('data-trix-attachment');
        $hasImage = $figure->getElementsByTagName('img')->length > 0;

        if (! $isAttachment && ! $hasImage) {
            return;
        }

        if (! in_array('cadde-rich-media', $classes, true)) {
            $classes[] = 'cadde-rich-media';
        }

        $figure->setAttribute('class', implode(' ', $classes));
        $figure->setAttribute('data-rich-media', 'editor');

        $this->setRatio($figure);
        $this->setAlignment($figure);
        $this->setFlow($figure);
        $this->relocateCaption($figure);
        $this->unwrapAnchor($figure);
        $this->prepareImage($figure);
    }

    private function setAlignment(DOMElement $figure): void
    {
        $className = strtolower((string) $figure->getAttribute('class'));
        $trixAttributes = strtolower((string) $figure->getAttribute('data-trix-attributes'));
        $style = strtolower((string) $figure->getAttribute('style'));

        $align = 'center';

        if (
            str_contains($className, 'attachment--align-left')
            || str_contains($trixAttributes, 'left')
            || str_contains($style, 'float: left')
            || str_contains($style, 'float:left')
        ) {
            $align = 'left';
        } elseif (
            str_contains($className, 'attachment--align-right')
            || str_contains($trixAttributes, 'right')
            || str_contains($style, 'float: right')
            || str_contains($style, 'float:right')
        ) {
            $align = 'right';
        } elseif ((string) $figure->getAttribute('data-rich-ratio') === 'portrait') {
            $align = 'right';
        }

        $figure->setAttribute('data-rich-align', $align);
    }

    private function setFlow(DOMElement $figure): void
    {
        $align = (string) $figure->getAttribute('data-rich-align');
        $ratio = (string) $figure->getAttribute('data-rich-ratio');

        $flow = in_array($align, ['left', 'right'], true) || $ratio === 'portrait'
            ? 'wrap'
            : 'block';

        $figure->setAttribute('data-rich-flow', $flow);
    }

    private function setRatio(DOMElement $figure): void
    {
        $width = $this->resolveDimension($figure, 'width');
        $height = $this->resolveDimension($figure, 'height');

        if (! $width || ! $height) {
            $attachment = $this->decodeAttachment($figure);

            if (! $width && isset($attachment['width']) && is_numeric($attachment['width'])) {
                $width = (int) $attachment['width'];
            }

            if (! $height && isset($attachment['height']) && is_numeric($attachment['height'])) {
                $height = (int) $attachment['height'];
            }
        }

        $ratio = 'auto';

        if ($width && $height) {
            $aspect = $width / max(1, $height);

            if ($aspect >= 1.65) {
                $ratio = 'wide';
            } elseif ($aspect >= 1.15) {
                $ratio = 'landscape';
            } elseif ($aspect >= 0.85) {
                $ratio = 'square';
            } else {
                $ratio = 'portrait';
            }
        }

        $figure->setAttribute('data-rich-ratio', $ratio);
    }

    private function relocateCaption(DOMElement $figure): void
    {
        $caption = null;

        foreach (iterator_to_array($figure->childNodes) as $child) {
            if ($child instanceof DOMElement && strtolower($child->tagName) === 'figcaption') {
                $caption = $child;
                break;
            }
        }

        if (! $caption) {
            /** @var \DOMElement|null $descendantCaption */
            $descendantCaption = $figure->getElementsByTagName('figcaption')->item(0);
            if (! $descendantCaption instanceof DOMElement) {
                return;
            }

            $caption = $descendantCaption;
        }

        $anchor = null;
        foreach (iterator_to_array($figure->childNodes) as $child) {
            if ($child instanceof DOMElement && strtolower($child->tagName) === 'a') {
                $anchor = $child;
                break;
            }
        }

        if ($caption->parentNode instanceof DOMElement && $caption->parentNode->isSameNode($figure)) {
            return;
        }

        if ($caption->parentNode) {
            $caption->parentNode->removeChild($caption);
        }

        if ($anchor && $anchor->parentNode && $anchor->parentNode->isSameNode($figure)) {
            if ($anchor->nextSibling) {
                $figure->insertBefore($caption, $anchor->nextSibling);
                return;
            }
        }

        $figure->appendChild($caption);
    }

    private function unwrapAnchor(DOMElement $figure): void
    {
        /** @var \DOMElement|null $anchor */
        $anchor = null;

        foreach (iterator_to_array($figure->childNodes) as $child) {
            if ($child instanceof DOMElement && strtolower($child->tagName) === 'a') {
                $anchor = $child;
                break;
            }
        }

        if (! $anchor instanceof DOMElement) {
            return;
        }

        $children = iterator_to_array($anchor->childNodes);

        foreach ($children as $child) {
            $figure->insertBefore($child, $anchor);
        }

        $anchor->parentNode?->removeChild($anchor);
    }

    private function prepareImage(DOMElement $figure): void
    {
        /** @var \DOMElement|null $image */
        $image = $figure->getElementsByTagName('img')->item(0);

        if (! $image instanceof DOMElement) {
            return;
        }

        if (! $image->hasAttribute('loading')) {
            $image->setAttribute('loading', 'lazy');
        }

        if (! $image->hasAttribute('decoding')) {
            $image->setAttribute('decoding', 'async');
        }
    }

    private function resolveDimension(DOMElement $figure, string $attribute): ?int
    {
        $value = $figure->getAttribute($attribute);

        if (is_numeric($value) && (int) $value > 0) {
            return (int) $value;
        }

        /** @var \DOMElement|null $image */
        $image = $figure->getElementsByTagName('img')->item(0);

        if ($image instanceof DOMElement) {
            $value = $image->getAttribute($attribute);

            if (is_numeric($value) && (int) $value > 0) {
                return (int) $value;
            }
        }

        return null;
    }

    private function decodeAttachment(DOMElement $figure): array
    {
        $value = html_entity_decode((string) $figure->getAttribute('data-trix-attachment'), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        if ($value === '') {
            return [];
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : [];
    }

    private function innerHtml(DOMElement $node): string
    {
        $html = '';

        foreach (iterator_to_array($node->childNodes) as $child) {
            $html .= $node->ownerDocument?->saveHTML($child) ?? '';
        }

        return $html;
    }
}
