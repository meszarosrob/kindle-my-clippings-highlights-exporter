<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Highlight;

class Content
{
    public function __construct(
        public readonly string $content,
    ) {
    }
}
