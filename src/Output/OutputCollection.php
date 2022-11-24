<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Output;

class OutputCollection
{
    public readonly array $all;

    public function __construct(Output ...$outputs)
    {
        $this->all = $outputs;
    }
}
