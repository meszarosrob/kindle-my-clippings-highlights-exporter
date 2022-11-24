<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\ImportExport;

class ReadFromFile
{
    public function __construct(
        private readonly string $filePath
    ) {
    }

    public function __invoke(): string
    {
        return file_get_contents($this->filePath);
    }
}
