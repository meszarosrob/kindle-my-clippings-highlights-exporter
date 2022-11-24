<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use Closure;
use KindleMyClippingsHighlightsExporter\Clipping;
use KindleMyClippingsHighlightsExporter\Highlight;

class ClippingCollectionToHighlightCollection
{
    public function __construct(
        private readonly ClippingToMeta $clippingToMeta,
        private readonly MetaToHighlight $metaToHighlight,
        private readonly Closure $metaFilter
    ) {
    }

    public function __invoke(Clipping\ClippingCollection $clippings): Highlight\HighlightCollection
    {
        $filteredMetas = array_filter(
            array_map(
                fn(Clipping\Clipping $clipping) => ($this->clippingToMeta)($clipping),
                $clippings->all
            ),
            $this->metaFilter
        );

        return new Highlight\HighlightCollection(
            ...array_map(
                fn(Clipping\Meta $meta) => ($this->metaToHighlight)($meta),
                $filteredMetas
            )
        );
    }
}
