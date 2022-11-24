<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Output;

class Output
{
    public function __construct(
        public readonly string $name,
        public readonly string $content
    ) {
    }
}
