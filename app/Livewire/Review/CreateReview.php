<?php

namespace App\Livewire\Review;

use Digikraaft\ReviewRating\Models\Review;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateReview extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public ?Model $record;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('subject')->required(),
                RichEditor::make('body')->required(),
            ])
            ->statePath('data')
            ->model(Review::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $author = \Auth::user();

        $this->record->review($data['body'], $author, 0, $data['subject']);

//        $record = Review::create($data);
//
//        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.review.create-review');
    }
}
