<?php

namespace App\Support\Text;

class TitleNormalizer
{
    protected static array $stopWords = [
        've', 'ile', 'icin', 'da', 'de', 'bir', 'bu', 'su', 'o',
        'mi', 'mu', 'mi', 'mu', 'ki', 'ama', 'fakat', 'lakin', 'ancak'
    ];

    public static function normalize(string $text): string
    {
        // 1. Lowercase via multi-byte
        $text = mb_strtolower($text, 'UTF-8');

        // 2. Turkish character normalization
        $search = ['ı', 'i', 'ö', 'ü', 'ç', 'ğ', 'ş'];
        $replace = ['i', 'i', 'o', 'u', 'c', 'g', 's'];
        $text = str_replace($search, $replace, $text);

        // 3. Remove punctuation
        $text = preg_replace('/[[:punct:]]/u', ' ', $text);

        // 4. Remove extra spaces
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);

        // 5. Remove stop words & get tokens
        $words = explode(' ', $text);
        $filtered = array_filter($words, function ($word) {
            return mb_strlen((string)$word) > 1 && !in_array((string)$word, self::$stopWords, true);
        });

        return implode(' ', $filtered);
    }

    public static function getTokens(string $text): array
    {
        $normalized = self::normalize($text);
        if (trim($normalized) === '') {
            return [];
        }
        return array_values(array_filter(explode(' ', $normalized)));
    }
}
