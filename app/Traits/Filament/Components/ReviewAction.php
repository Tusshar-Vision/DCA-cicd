<?php

namespace App\Traits\Filament\Components;

use App\Filament\Components\SourceInput;
use App\Forms\Components\CKEditor;
use App\Models\Article;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Pboivin\FilamentPeek\Forms\Actions\InlinePreviewAction;

trait ReviewAction
{
    public function reviewAction() {
        return Action::make('Review')
            ->tooltip('Review')
            ->icon('heroicon-s-chat-bubble-left-right')
            ->visible(function (Article $record) {
                $user = Auth::user();
                return
                    (
                        $user->can('review_article') &&
                        $record->reviewer_id === $user->id &&
                        $record->status !== 'Published'
                    ) || (
                        $user->can('review_article') &&
                        $user->hasRole(['super_admin', 'admin']) &&
                        $record->status !== 'Published'
                    );
            })
            ->fillForm(fn (Article $record): array => [
                'title' => $record->title,
                'short_title' => $record->short_title,
                'subject' => $record->topic->name,
                'section' => $record->topicSection->name ?? '',
                'sources' => $record->sources,
                'subSection' => $record->topicSubSection->name ?? '',
                'tags' => $record->tags,
                'status' => $record->status,
                'body' => $record->latestReview()->review ?? '',
                'references' => $record->references,
            ])
            ->form([
                TextInput::make('title')->disabled(),
                TextInput::make('short_title')->disabled(),
                Group::make()->schema([
                    TextInput::make('subject')->disabled(),
                    TextInput::make('section')->disabled(),
                    TextInput::make('subSection')->disabled(),
                ])->columns(3),
                SourceInput::make('sources')->placeholder('')->disabled(),
                SpatieTagsInput::make('tags')->placeholder('')->disabled(),
                Section::make('Article Content')
                    ->relationship('content')
                    ->schema([
                        CKEditor::make('content')->disabled(),
                    ])->collapsible(),

                Section::make('Review Comment')->schema([
                    Select::make('status')->options([
                        "Draft" => "Draft",

                        'In Process' => [
                            "Improve" => "Improve",
                            "Changes Incorporated" => "Changes Incorporated",
                        ],
                        'Reviewed' => [
                            "Reject" => "Reject",
                            "Final" => "Final",
                        ]
                    ])->default(function(?Model $record) {
                        return $record->status;
                    })->required()
                        ->disableOptionWhen(fn (string $value): bool => $value === 'Changes Incorporated' || $value === 'Draft'),

                    RichEditor::make('body')
                        ->placeholder('Add your comments...')
                        ->label('')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                        ]),
                ]),
                Section::make('References')->schema([
                    SourceInput::make('references')->hiddenLabel()->placeholder('Add References'),
                ]),
            ])->slideOver()
            ->action(function (array $data, Model $record) {
                $author = Auth::user();

                if($record->hasReview())
                    $record->latestReview()->update(['review' => $data['body']]);
                else
                    ($data['body'] !== null) ? $record->review($data['body'], $author, 0) : null;

                $record->setStatus($data['status']);
                $record->references = $data['references'];
                $record->save();
            })->iconButton();
    }
}
