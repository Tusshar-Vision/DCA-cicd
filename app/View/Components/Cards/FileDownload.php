<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileDownload extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $file
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.file-download');
    }
}
