<?php

declare(strict_types=1);

use KindleMyClippingsHighlightsExporter\Clipping;
use KindleMyClippingsHighlightsExporter\Command;
use KindleMyClippingsHighlightsExporter\MyClippings;

require __DIR__ . '/vendor/autoload.php';

$importMyClippingsDataFromFile = new Command\ImportExport\ReadFromFile(__DIR__ . '/data/My Clippings.txt');
$convertMyClippingsToOutputCollection = new Command\Convert\MyClippingsToOutputCollectionFacade(
    new Command\Convert\EnglishClippingToMeta(),
    fn(Clipping\Meta $meta) => $meta->type === 'Highlight',
    new Command\Convert\HighlightToBacklinkedOutput(),
);
$writeOutputToFile = new Command\ImportExport\WriteToFile(__DIR__ . '/data/', '.md');

$outputCollection = $convertMyClippingsToOutputCollection(
    new MyClippings\Data(
        $importMyClippingsDataFromFile()
    )
);

foreach ($outputCollection->all as $output) {
    $writeOutputToFile($output);
}
