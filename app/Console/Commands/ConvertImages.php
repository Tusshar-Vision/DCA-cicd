<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ConvertImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert images from base64 and upload them to s3';

    /**
     * Execute the console command.
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

                // Get all image tags
                $images = $dom->getElementsByTagName('img');

                if ($images->length !== 0) {

                    foreach ($images as $image) {
                        $src = $image->getAttribute('src');

                        // Check if src attribute contains base64 data
                        if (str_starts_with($src, 'data:image')) {
                            // Extract base64 image data
                            $base64Data = substr($src, strpos($src, ',') + 1);
                            // Decode base64 data
                            $imageData = base64_decode($base64Data);
                            // Upload image
                            $s3Path = 'uploads/' . $article->id . '_' . uniqid() . '.png'; // Adjust file extension as needed
                            Storage::disk('s3_public')->put($s3Path, $imageData);

                            $image->setAttribute('src', Storage::disk('s3_public')->url($s3Path));
                        }
                    }

                    // Save the updated content back
                    $updatedContent = $dom->saveHTML();
                    $article->content->content = $updatedContent;
                    $article->content->save();
                }
            }
        });
        $this->info('Operation was completed successfully!');
    }
}
