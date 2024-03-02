<?php

namespace App\Traits;

trait StringFormatting
{
    public function formatString($inputString): string
    {
        // Replace hyphens and similar characters with a space
        $formattedString = str_replace(['-', '_'], ' ', $inputString);

        // Convert "and" symbols (&) back to "&", if they were converted to "and"
        $formattedString = str_replace(' and ', ' & ', $formattedString);

        // Capitalize the first letter of each word
        $formattedString = ucwords($formattedString);

        return $this->capitalizeWordsInParentheses($formattedString);
    }

    private function capitalizeWordsInParentheses($text): array|string|null
    {
        return preg_replace_callback('/\((.*?)\)/', function($matches) {
            // Capitalize each word inside the parentheses
            return '(' . ucwords($matches[1]) . ')';
        }, $text);
    }
}
