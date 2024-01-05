<?php

namespace App\Livewire\Widgets;

use App\DTO\ArticleDTO;
use Illuminate\View\View;
use Livewire\Component;

class AddNote extends Component
{
    public ArticleDTO $article;
    public $note;

    public function mount(ArticleDTO $articleDTO, $note): void
    {
        $this->article = $articleDTO;
        $this->note = $note;
    }

    public function render(): View
    {
        return view('livewire.widgets.add-note');
    }
}
