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
        return sprintf(
            '%s... %s',
            $this->trimContent($highlight->content),
            substr((string)$highlight->dateTime->getTimestamp(), -4)
        );
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

    private function trimContent(Highlight\Content $content): string
    {
        $minCharLength = 40;
        $maxLength = mb_strpos(
            $content->content,
            ' ',
            min($minCharLength, mb_strlen($content->content))
        );

        if ($maxLength === false) {
            $maxLength = $minCharLength;
        }

        return mb_substr($content->content, 0, $maxLength);
    }
}
