<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Clipping;

class Meta
{
    public function __construct(
        public readonly string $publicationTitle,
        public readonly string $publicationAuthor,
        public readonly string $location,
        public readonly string $year,
        public readonly string $month,
        public readonly string $day,
        public readonly string $hour,
        public readonly string $minute,
        public readonly string $second,
        public readonly string $dayPeriod,
        public readonly string $content,
        public readonly Type $type,
    ) {
    }
}
