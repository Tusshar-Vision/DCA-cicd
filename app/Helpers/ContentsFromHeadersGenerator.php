<?php

namespace App\Helpers;

class ContentsFromHeadersGenerator
{
    public function generateTOC($htmlContent): array
    {
        $dom = new \DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($htmlContent, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $xpath = new \DOMXPath($dom);
        $headings = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');
        $toc = [];
        $ids = [];

        foreach ($headings as $heading) {
            $level = (int) substr($heading->tagName, 1);
            $text = trim($heading->textContent);
            $idBase = strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', $text)));
            $id = $idBase;
            $counter = 1;

            while (in_array($id, $ids)) {
                $id = $idBase . '-' . $counter++;
            }

            $ids[] = $id;
            $heading->setAttribute('id', $id);

            $toc[] = [
                'level' => $level,
                'text' => $text,
                'link' => '#' . $id,
            ];
        }

        $updatedHTMLContent = $dom->saveHTML();

        return [
            'toc' => $toc,
            'updatedHTMLContent' => $updatedHTMLContent,
        ];
    }
}
