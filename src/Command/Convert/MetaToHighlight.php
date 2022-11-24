<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use DateTimeImmutable;
use KindleMyClippingsHighlightsExporter\Clipping;
use KindleMyClippingsHighlightsExporter\Highlight;

class MetaToHighlight
{
    public function __invoke(Clipping\Meta $meta): Highlight\Highlight
    {
        return new Highlight\Highlight(
            $this->content($meta),
            $this->publication($meta),
            $this->location($meta),
            $this->dateTimeImmutable($meta),
        );
    }

    public function content(Clipping\Meta $meta): Highlight\Content
    {
        return new Highlight\Content($meta->content);
    }

    public function publication(Clipping\Meta $meta): Highlight\Publication
    {
        return new Highlight\Publication(
            $meta->publicationTitle,
            $meta->publicationAuthor,
        );
    }

    private function location(Clipping\Meta $meta): Highlight\Location
    {
        [$from, $to] = array_map(
            fn(string $val) => (int)$val,
            explode('-', $meta->location)
        ) + [null, null];

        return new Highlight\Location(
            $from,
            $to ?? $from
        );
    }

    private function dateTimeImmutable(Clipping\Meta $meta): DateTimeImmutable
    {
        $dateTime = DateTimeImmutable::createFromFormat(
            'Y F j g i s A',
            sprintf(
                '%s %s %s %s %s %s %s',
                $meta->year,
                $meta->month,
                $meta->day,
                $meta->hour,
                $meta->minute,
                $meta->second,
                $meta->dayPeriod,
            )
        );

        return $dateTime !== false ? $dateTime : new DateTimeImmutable();
    }
}
