<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserScore extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $index,
        public int $score
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.user-score');
    }
}
