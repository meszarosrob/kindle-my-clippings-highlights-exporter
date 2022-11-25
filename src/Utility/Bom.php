<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Utility;

class Bom
{
    public static function remove(string $value): string
    {
        return \fab2s\Bom\Bom::drop($value);
    }
}
