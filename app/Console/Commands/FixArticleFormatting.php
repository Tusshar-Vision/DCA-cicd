<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FixArticleFormatting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-article-formatting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert formatting of articles';

    private function replacePTagWithH2($elements, $dom): void
    {
        // Iterate over the selected elements
        foreach ($elements as $element) {
            // Create a new <h2> element
            $heading = $dom->createElement('h2');

            // Copy the content of the <p> element to the <h2> element
            foreach ($element->childNodes as $child) {
                if ($child->nodeName === 'span') {
                    // Remove the style attribute from the <span> element
                    $child->removeAttribute('style');
                }
                if ($child->nodeName === 'strong') {
                    // Remove the <strong> element
                    $element->removeChild($child);
                }
                $heading->appendChild($dom->importNode($child, true));
            }

            // Replace the <p> element with the <h2> element
            $element->parentNode->replaceChild($heading, $element);
        }
    }

    private function fixColorInTag($elements): void {
        // Iterate over the selected elements
        foreach ($elements as $element) {
            // Remove the style attribute from the <span> element
            $span = $element->getElementsByTagName('span')->item(0);
            $span->removeAttribute('style');
        }
    }

    private function replacePTagWithH3InTable($elements, $dom): void
    {
        // Iterate over the selected elements
        foreach ($elements as $element) {
            // Create a new <h2> element
            $heading = $dom->createElement('h3');

            // Copy the content of the <p> element to the <h2> element
            foreach ($element->childNodes as $child) {
                if ($child->nodeName === 'span') {
                    // Remove the style attribute from the <span> element
                    $child->removeAttribute('style');
                }
                if ($child->nodeName === 'strong') {
                    // Remove the <strong> element
                    $element->removeChild($child);
                }
                $heading->appendChild($dom->importNode($child, true));
            }

            // Replace the <p> element with the <h2> element
            $element->parentNode->replaceChild($heading, $element);
        }
    }

    // Function to remove extra occurrences of the element
    function removeExtraOccurrences($elements, $dom, $article): void
    {
        $consecutiveCount = 0;
        foreach ($elements as $element) {
            $currentNode = $element;
            dump($dom->saveHTML($element), $article->title);
//            while ($currentNode->parentNode) {
//                // If the parent node is a <p> tag and the previous sibling is the same element
//                if ($currentNode->parentNode->nodeName == 'p' && $currentNode->previousSibling && $currentNode->previousSibling->isSameNode($currentNode)) {
//                    $consecutiveCount++;
//                    // If it's not the first occurrence and consecutive, remove it
//                    if ($consecutiveCount > 1) {
//                        $currentNode->parentNode->removeChild($currentNode);
//                        break; // Break the loop after removing the element
//                    }
//                } else {
//                    $consecutiveCount = 0; // Reset consecutive count if not consecutive
//                }
//                $currentNode = $currentNode->parentNode;
//            }
        }
    }

    /**
     * Execute the console command.
     * @throws \DOMException
     */
    public function handle(): void
    {
        Article::all()->each(function (Article $article) {
            $content = $article->content?->content;

            if ($content !== null) {
                // Create a DOMDocument instance
                $dom = new \DOMDocument();
                // Load the HTML content
                $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_NOERROR | LIBXML_HTML_NODEFDTD);

                // Create a DOMXPath instance to use XPath expressions
                $xpath = new \DOMXPath($dom);

                // Define the XPath expression to select <p> elements with <span> and <strong> children
//                $queryForPTagOutsideTable = '//p[not(ancestor::table)]/span[@style="color:hsl(226,92%,37%);" and strong]';
//                $queryForPTagOutsideTableFormatting1 = '//p[not(ancestor::table)]/span[@style="color:hsl(222,93%,37%);" and strong]';
//                $queryForPTagOutsideTableFormatting2 = '//p[not(ancestor::table)]/span[@style="color:hsl(226,93%,37%);" and strong]';
//                $queryForPTagOutsideTableFormatting3 = '//p[not(ancestor::table)]/span[@style="color:hsl( 226, 92%, 37% );" and strong]';
//                $queryForPTagOutsideTableFormatting4 = '//p[not(ancestor::table)]/span[@style="color:hsl( 226, 92%, 37% );"]';
//
//                // Find elements matching the XPath expression
//                $elements = $xpath->query($queryForPTagOutsideTable);
//                $this->replacePTagWithH2($elements, $dom);
//                $elements = $xpath->query($queryForPTagOutsideTableFormatting1);
//                $this->replacePTagWithH2($elements, $dom);
//                $elements = $xpath->query($queryForPTagOutsideTableFormatting2);
//                $this->replacePTagWithH2($elements, $dom);
//                $elements = $xpath->query($queryForPTagOutsideTableFormatting3);
//                $this->replacePTagWithH2($elements, $dom);
//                $elements = $xpath->query($queryForPTagOutsideTableFormatting4);
//                $this->replacePTagWithH2($elements, $dom);
//
//                // Define the XPath expression to select <p> elements inside <table> elements
//                $queryForPTagInsideTable = '//table//p/span[@style="color:hsl(226,92%,37%);" and strong]';
//                $queryForPTagInsideTableFormatting1 = '//table//p/span[@style="color:hsl( 226, 92%, 37% );" and strong]';
//                $queryForPTagInsideTableFormatting2 = '//table//span[@style="color:hsl(226,92%,37%);" and strong]';
//                $queryForPTagInsideTableFormatting3 = '//table//span[@style="color:hsl( 226, 92%, 37% );" and strong]';
//
//                // Find elements matching the XPath expression
//                $elements = $xpath->query($queryForPTagInsideTable);
//                $this->replacePTagWithH3InTable($elements, $dom);
//                $elements = $xpath->query($queryForPTagInsideTableFormatting1);
//                $this->replacePTagWithH3InTable($elements, $dom);
//                $elements = $xpath->query($queryForPTagInsideTableFormatting2);
//                $this->replacePTagWithH3InTable($elements, $dom);
//                $elements = $xpath->query($queryForPTagInsideTableFormatting3);
//                $this->replacePTagWithH3InTable($elements, $dom);
//
//
//                $queryForLiTagWithColor = '//li[span[@style="color:hsl(226,92%,37%);"]]';
//                $queryForLiTagWithColorFormatting1 = '//li[span[@style="color:hsl( 226, 92%, 37% );"]]';
//                $queryForLiTagWithColorFormatting2 = '//li[span[@style="background-color:white;color:hsl(226,92%,37%);"]]';
//                $queryForLiTagWithColorFormatting3 = '//li[span[@style="color:rgb(8,48,181);"]]';
//                $queryForH3TagWithColorFormatting1 = '//h3[span[@style="color:hsl(226,92%,37%);"]]';
//                $queryForPTagWithColorFormatting1 = '//p[span[@style="color:hsl(226,92%,37%);"]]';
//
//                // Find elements matching the XPath expression
//                $elements = $xpath->query($queryForLiTagWithColor);
//                $this->fixColorInTag($elements);
//                $elements = $xpath->query($queryForLiTagWithColorFormatting1);
//                $this->fixColorInTag($elements);
//                $elements = $xpath->query($queryForLiTagWithColorFormatting2);
//                $this->fixColorInTag($elements);
//                $elements = $xpath->query($queryForLiTagWithColorFormatting3);
//                $this->fixColorInTag($elements);
//                $elements = $xpath->query($queryForH3TagWithColorFormatting1);
//                $this->fixColorInTag($elements);
//                $elements = $xpath->query($queryForPTagWithColorFormatting1);
//                $this->fixColorInTag($elements);

                // Define the XPath expression to select <p> elements with the specific style attribute and content
                $query = '//p[string-length() = 1]';
                // Find elements matching the XPath expression
                $elements = $xpath->query($query);
//                 If there are multiple consecutive occurrences of the element, keep only the first one
                $this->removeExtraOccurrences($elements, $dom, $article);
//
//
//                // Save the updated content back
//                $updatedContent = $dom->saveHTML();
//                $article->content->content = $updatedContent;
//                $article->content->save();
            }
        });
        $this->info('Operation was completed successfully!');
    }
}
