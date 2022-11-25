<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\MyClippings;

class Data
{
    public function __construct(
        public readonly string $content,
    ) {
    }
}
