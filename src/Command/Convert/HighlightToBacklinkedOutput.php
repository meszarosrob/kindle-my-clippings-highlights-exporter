<?php

declare(strict_types=1);

namespace KindleMyClippingsHighlightsExporter\Command\Convert;

use KindleMyClippingsHighlightsExporter\Highlight;
use KindleMyClippingsHighlightsExporter\Output;

class HighlightToBacklinkedOutput implements HighlightToOutput
{
    public function __invoke(Highlight\Highlight $highlight): Output\Output
    {
        return new Output\Output(
            $this->name($highlight),
            $this->content($highlight)
        );
    }

    public function name(Highlight\Highlight $highlight): string
    {
        return md5(serialize($highlight));
    }

    public function content(Highlight\Highlight $highlight): string
    {
        $template = <<<CONTENT
        > :content
        
        [[:title]]
        [[:author]]
        CONTENT;

        return strtr(
            $template,
            [
                ':title' => $highlight->publication->title,
                ':author' => $highlight->publication->author,
                ':content' => $highlight->content->content,
            ]
        );
    }
}
