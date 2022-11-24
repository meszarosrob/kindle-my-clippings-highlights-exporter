<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Highlight;

class Publication
{
    public function __construct(
        public readonly string $title,
        public readonly string $author,
    ) {
    }
}
