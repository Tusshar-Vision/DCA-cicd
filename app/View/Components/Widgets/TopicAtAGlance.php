<?php

namespace App\View\Components\Widgets;

use App\Models\Infographic;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopicAtAGlance extends Component
{
    public function __construct(public ?Infographic $infographic) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.topic-at-a-glance');
    }
}
