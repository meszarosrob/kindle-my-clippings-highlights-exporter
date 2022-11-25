<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use KindleMyClippingsHighlightsExporter\Clipping;
use KindleMyClippingsHighlightsExporter\Utility;

class EnglishClippingToMeta implements ClippingToMeta
{
    public function __invoke(Clipping\Clipping $clipping): Clipping\Meta
    {
        preg_match_all(
            $this->regex(),
            $clipping->content,
            $matches
        );

        $parts = array_map(
            fn($value) => trim(
                Utility\Bom::remove($value[0] ?? '')
            ),
            array_filter(
                $matches,
                fn($value, $key) => !is_numeric($key),
                ARRAY_FILTER_USE_BOTH
            )
        );

        return new Clipping\Meta(
            $parts['publicationTitle'],
            $parts['publicationAuthor'],
            $parts['location'],
            $parts['year'],
            $parts['month'],
            $parts['day'],
            $parts['hour'],
            $parts['minute'],
            $parts['second'],
            $parts['dayPeriod'],
            $parts['content'],
            match ($parts['type']) {
                'Highlight' => Clipping\Type::Highlight,
                default => Clipping\Type::Other
            }
        );
    }

    private function regex(): string
    {
        $patternParts = [
            '(?<publicationTitle>.+) \((?<publicationAuthor>.+)\)\r*\n.+?',
            '(?<type>Note|Highlight|Bookmark).+?(?<location>[0-9-\-]+).+?',
            ',\s(?<month>[a-zA-Z]+)\s(?<day>[0-9]+),\s(?<year>[0-9]+)\s',
            '(?<hour>[0-9]+):(?<minute>[0-9]+):(?<second>[0-9]+)\s(?<dayPeriod>AM|PM)',
            '[\r|\n\r|\n]*(?<content>.*)',
        ];

        return sprintf(
            '/%s/',
            implode('', $patternParts)
        );
    }
}
