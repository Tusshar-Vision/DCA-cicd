<?php

namespace App\Helpers;

use App\Enums\Initiatives;
use App\Exceptions\IconNotFoundException;

class SvgIconsHelper
{
    /**
     * @throws IconNotFoundException
     */
    public static function getSvgIcon(string $iconFile): string
    {
        $path = resource_path("svg/$iconFile" . ".svg");

        // Check if the file exists
        if (file_exists($path)) {
            // Load the SVG content from the file
            return file_get_contents($path);
        } else {
            throw (new IconNotFoundException('Icon ' . $iconFile . ' to the function is invalid.'));
        }
    }
}
