<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use KindleMyClippingsHighlightsExporter\Clipping;
use KindleMyClippingsHighlightsExporter\MyClippings;

class EntryCollectionToClippingCollection
{
    public function __invoke(MyClippings\EntryCollection $entries): Clipping\ClippingCollection
    {
        return new Clipping\ClippingCollection(
            ...array_map(
                fn(MyClippings\Entry $entry) => new Clipping\Clipping($entry->content),
                $entries->all,
            )
        );
    }
}
