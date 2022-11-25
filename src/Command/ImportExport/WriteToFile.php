<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\ImportExport;

use KindleMyClippingsHighlightsExporter\Output;

class WriteToFile
{
    private readonly string $directoryPath;
    private readonly string $fileExtension;

    public function __construct(
        string $directoryPath,
        string $fileExtension,
    ) {
        $this->fileExtension = ltrim($fileExtension, '.');
        $this->directoryPath = rtrim($directoryPath, '/');
    }

    public function __invoke(Output\Output $output): void
    {
        file_put_contents(
            "{$this->directoryPath}/{$output->name}.{$this->fileExtension}",
            $output->content
        );
    }
}
