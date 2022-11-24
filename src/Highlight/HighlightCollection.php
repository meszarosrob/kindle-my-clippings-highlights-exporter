<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Highlight;

class HighlightCollection
{
    public readonly array $all;

    public function __construct(Highlight ...$highlights)
    {
        $this->all = $highlights;
    }
}
