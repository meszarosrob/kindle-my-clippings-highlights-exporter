<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\MyClippings;

class Entry
{
    public function __construct(
        public readonly string $content,
    ) {
    }
}
