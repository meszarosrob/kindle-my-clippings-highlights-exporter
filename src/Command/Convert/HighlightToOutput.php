<?php

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use KindleMyClippingsHighlightsExporter\Highlight;
use KindleMyClippingsHighlightsExporter\Output;

interface HighlightToOutput
{
    public function __invoke(Highlight\Highlight $highlight): Output\Output;
}
