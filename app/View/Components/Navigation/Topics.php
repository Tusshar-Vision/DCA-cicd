<?php

namespace App\View\Components\Navigation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Topics extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $topics,
        public $publishedDate
    )
    {}

    public function formatString($inputString): string
    {
        // Replace hyphens and similar characters with a space
        $formattedString = str_replace(['-', '_'], ' ', $inputString);

        // Convert "and" symbols (&) back to "&", if they were converted to "and"
        $formattedString = str_replace(' and ', ' & ', $formattedString);

        // Capitalize the first letter of each word
        return ucwords($formattedString);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.topics');
    }
}
