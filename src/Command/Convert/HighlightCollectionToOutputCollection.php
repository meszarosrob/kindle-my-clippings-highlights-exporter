<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use KindleMyClippingsHighlightsExporter\Highlight;
use KindleMyClippingsHighlightsExporter\Output;

class HighlightCollectionToOutputCollection
{
    public function __construct(
        private readonly HighlightToOutput $highlightToOutput,
    ) {
    }

    public function __invoke(Highlight\HighlightCollection $highlightCollection): Output\OutputCollection
    {
        return new Output\OutputCollection(
            ...array_map(
                fn(Highlight\Highlight $highlight) => ($this->highlightToOutput)($highlight),
                $highlightCollection->all
            )
        );
    }
}
