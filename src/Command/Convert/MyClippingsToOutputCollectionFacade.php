<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use Closure;
use KindleMyClippingsHighlightsExporter\Output;
use KindleMyClippingsHighlightsExporter\MyClippings;

use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\pipe;

class MyClippingsToOutputCollectionFacade
{
    public function __construct(
        private readonly ClippingToMeta $clippingToMeta,
        private readonly Closure $metaFilter,
        private readonly HighlightToOutput $highlightToOutput,
    ) {
    }

    public function __invoke(MyClippings\Data $myClippingsSource): Output\OutputCollection
    {
        $converters = [
            new SourceToEntryCollection(),
            new EntryCollectionToClippingCollection(),
            new ClippingCollectionToHighlightCollection(
                $this->clippingToMeta,
                new MetaToHighlight(),
                $this->metaFilter
            ),
            new HighlightCollectionToOutputCollection(
                $this->highlightToOutput
            ),
        ];

        return apply(pipe(...$converters), [$myClippingsSource]);
    }
}
