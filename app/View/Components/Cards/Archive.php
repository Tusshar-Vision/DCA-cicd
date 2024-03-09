<?php

namespace App\View\Components\Cards;

use App\Services\ArticleService;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Archive extends Component
{
    public $date, $title, $slug, $url, $downloadLink;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $package
    )
    {
        $this->date = Carbon::parse($package->publishedAt)->format('Y-m-d');
        $this->title = Carbon::parse($package->publishedAt)->monthName;
        $this->slug = $package->article->first()->slug;

        $this->url = ArticleService::getArticleUrlFromSlug($this->slug);
        $this->downloadLink = $package->media?->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards..archive');
    }
}
