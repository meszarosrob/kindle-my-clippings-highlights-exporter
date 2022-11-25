<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use KindleMyClippingsHighlightsExporter\Clipping;
use KindleMyClippingsHighlightsExporter\Highlight;

class ClippingCollectionToHighlightCollection
{
    public function __construct(
        private readonly ClippingToMeta $clippingToMeta,
        private readonly MetaToHighlight $metaToHighlight,
    ) {
    }

    public function __invoke(Clipping\ClippingCollection $clippings): Highlight\HighlightCollection
    {
        $onlyHighlightMetas = array_filter(
            array_map(
                fn(Clipping\Clipping $clipping) => ($this->clippingToMeta)($clipping),
                $clippings->all
            ),
            fn(Clipping\Meta $meta) => $meta->type === Clipping\Type::Highlight,
        );

        return new Highlight\HighlightCollection(
            ...array_map(
                fn(Clipping\Meta $meta) => ($this->metaToHighlight)($meta),
                $onlyHighlightMetas
            )
        );
    }
}
