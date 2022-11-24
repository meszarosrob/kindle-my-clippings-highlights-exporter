<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Clipping;

class ClippingCollection
{
    public readonly array $all;

    public function __construct(Clipping ...$clippings)
    {
        $this->all = $clippings;
    }
}
