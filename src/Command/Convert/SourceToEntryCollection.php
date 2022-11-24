<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use KindleMyClippingsHighlightsExporter\MyClippings;

class SourceToEntryCollection
{
    private const DELIMITER = '==========';

    public function __invoke(MyClippings\Data $file): MyClippings\EntryCollection
    {
        $chunks = array_filter(
            array_map(
                fn(string $content) => trim($content),
                explode(self::DELIMITER, $file->content)
            ),
            fn(string $content) => !empty($content)
        );

        return new MyClippings\EntryCollection(
            ...array_map(
                fn(string $content) => new MyClippings\Entry($content),
                $chunks
            )
        );
    }
}
