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

    /**
     * Execute the console command.
     * @throws \DOMException
     */
    public function handle(): void
    {
        Article::all()->each(function (Article $article) {
            $content = $article->content->content;

            if ($content !== null) {
                // Create a DOMDocument instance
                $dom = new \DOMDocument();
                // Load the HTML content
                $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_NOERROR | LIBXML_HTML_NODEFDTD);

                // Create a DOMXPath instance to use XPath expressions
                $xpath = new \DOMXPath($dom);

                // Define the XPath expression to select <p> elements with <span> and <strong> children
                $queryForPTagOutsideTable = '//p[not(ancestor::table)]/span[@style="color:hsl(226,92%,37%);" and strong]';

                // Find elements matching the XPath expression
                $elements = $xpath->query($queryForPTagOutsideTable);

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

                // Define the XPath expression to select <p> elements inside <table> elements
                $queryForPTagInsideTable = '//table//p/span[@style="color:hsl(226,92%,37%);" and strong]';
                // Find elements matching the XPath expression
                $elements = $xpath->query($queryForPTagInsideTable);

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

                // Define the XPath expression to select <p> elements inside <table> elements
                $queryForLiTagWithColor = '//li[span[@style="color:hsl(226,92%,37%);"]]';
                // Find elements matching the XPath expression
                $elements = $xpath->query($queryForLiTagWithColor);

                // Iterate over the selected elements
                foreach ($elements as $element) {
                    // Remove the style attribute from the <span> element
                    $span = $element->getElementsByTagName('span')->item(0);
                    $span->removeAttribute('style');
                }

                // Save the updated content back
                $updatedContent = $dom->saveHTML();
                $article->content->content = $updatedContent;
                $article->content->save();
            }
        });
        $this->info('Operation was completed successfully!');
    }
}
