<?php

namespace Mifumi323\TableOfContents;

/**
 * 目次を取り扱います。
 * `<hn id="ID">見出し</hn>`の形式の見出しをリストとして表示します。
 * 複数種の見出しを使用した場合、見出しレベルに応じた階層が形成されます。
 */
class TableOfContents
{
    public static function generate(string $html): string
    {
        $toc = self::parse($html);
        if ($toc === null) {
            return '';
        }

        return '<nav class="table-of-contents">'.$toc->toHtml().'</nav>';
    }

    public static function parse(string $html): ?self
    {
        $count = preg_match_all('/<h([1-6]) id="([^"<>]+)">(.+?)<\/h[1-6]/i', $html, $matches);
        if ($count <= 0) {
            return null;
        }
        $headings = [
            new self(0, '', '', []),
        ];
        for ($i = 0; $i < $count; $i++) {
            $level = (int) $matches[1][$i];
            $heading = new self($level, $matches[2][$i], $matches[3][$i], []);
            for ($j = count($headings) - 1; $j >= 0; $j--) {
                if ($headings[$j]->level < $level) {
                    $headings[$j]->children[] = $heading;
                    break;
                }
            }
            $headings[] = $heading;
        }

        return $headings[0];
    }

    /** @param self[] $children */
    private function __construct(
        private int $level,
        private string $id,
        private string $subject,
        private array $children,
    ) {
    }

    public function toHtml(): string
    {
        $toc_html = '';
        if ($this->subject !== '') {
            $toc_html .= '<li>';
            $toc_html .= '<a href="#'.$this->id.'">';
            $subject = $this->subject;
            if (str_contains($subject, 'class="hashlink"')) {
                $subject = preg_replace('/<a [^<>]*class="hashlink"[^<>]*>[^<>]*<\/a>/', '', $subject);
            }
            $toc_html .= strip_tags($subject);
            $toc_html .= '</a>';
        }
        if (count($this->children) > 0) {
            $toc_html .= '<ol>';
            foreach ($this->children as $child) {
                $toc_html .= $child->toHtml();
            }
            $toc_html .= '</ol>';
        }
        if ($this->subject !== '') {
            $toc_html .= '</li>';
        }

        return $toc_html;
    }
}
