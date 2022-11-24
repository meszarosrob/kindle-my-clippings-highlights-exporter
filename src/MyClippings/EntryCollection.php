<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\MyClippings;

class EntryCollection
{
    public readonly array $all;

    public function __construct(Entry ...$entries)
    {
        $this->all = $entries;
    }
}
