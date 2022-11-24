<?php

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use KindleMyClippingsHighlightsExporter\Clipping;

interface ClippingToMeta
{
    public function __invoke(Clipping\Clipping $clipping): Clipping\Meta;
}
