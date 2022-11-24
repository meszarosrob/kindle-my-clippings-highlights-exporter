<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Highlight;

use DateTimeImmutable;

class Highlight
{
    public function __construct(
        public readonly Content $content,
        public readonly Publication $publication,
        public readonly Location $location,
        public readonly DateTimeImmutable $dateTime,
    ) {
    }
}
