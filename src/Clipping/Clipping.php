<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Clipping;

class Clipping
{
    public function __construct(
        public readonly string $content,
    ) {
    }
}
