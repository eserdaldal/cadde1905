<?php

namespace Tests\Unit;

use App\Services\RichContent\RichContentRenderer;
use Tests\TestCase;

class RichContentRendererTest extends TestCase
{
    public function test_it_normalizes_trix_attachments_with_global_semantics(): void
    {
        $html = '<p>Text</p><figure data-trix-attachment="{&quot;width&quot;:401,&quot;height&quot;:851}" class="attachment attachment--preview attachment--png"><a href="https://example.test/image.png"><img src="https://example.test/image.png" width="401" height="851"><figcaption class="attachment__caption attachment__caption--edited">Fatih Terim</figcaption></a></figure>';

        $rendered = app(RichContentRenderer::class)->render($html);

        $this->assertStringContainsString('data-rich-media="editor"', $rendered);
        $this->assertStringContainsString('data-rich-ratio="portrait"', $rendered);
        $this->assertStringContainsString('data-rich-align="right"', $rendered);
        $this->assertStringContainsString('data-rich-flow="wrap"', $rendered);
        $this->assertStringContainsString('class="attachment attachment--preview attachment--png cadde-rich-media"', $rendered);
        $this->assertStringNotContainsString('<a href="https://example.test/image.png">', $rendered);
        $this->assertStringContainsString('<figcaption class="attachment__caption attachment__caption--edited">Fatih Terim</figcaption>', $rendered);
    }

    public function test_it_preserves_landscape_media_as_a_block_surface(): void
    {
        $html = '<figure data-trix-attachment="{&quot;width&quot;:1600,&quot;height&quot;:900}" class="attachment"><img src="https://example.test/landscape.jpg" width="1600" height="900"><figcaption>Caption</figcaption></figure>';

        $rendered = app(RichContentRenderer::class)->render($html);

        $this->assertStringContainsString('data-rich-ratio="wide"', $rendered);
        $this->assertStringContainsString('data-rich-media="editor"', $rendered);
        $this->assertStringContainsString('data-rich-flow="block"', $rendered);
    }
}
