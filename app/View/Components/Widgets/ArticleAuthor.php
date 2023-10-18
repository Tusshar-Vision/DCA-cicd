<?php

namespace App\View\Components\Widgets;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleAuthor extends Component
{

    public $authorName;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $authorId
    )
    {
        $this->getAuthorName();
    }

    public function getAuthorName() {
        $this->authorName = User::where('id', '=', $this->authorId)->first()->name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.article-author');
    }
}
