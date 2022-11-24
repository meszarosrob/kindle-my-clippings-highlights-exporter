<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Highlight;

class Location
{
    public function __construct(
        public readonly int $from,
        public readonly int $to,
    ) {
    }
}
