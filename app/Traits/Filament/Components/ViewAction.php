<?php

namespace App\Traits\Filament\Components;

use App\Filament\Components\SourceInput;
use App\Forms\Components\CKEditor;
use App\Models\Article;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;

trait ViewAction
{
    public function viewAction() {
        return Action::make('View')
            ->visible(function (Article $record) {
                if ($record->status === 'Published') return true;

                $user = Auth::user();

                if ($record->reviewer_id === $user->id) return false;

                if ($user->hasRole(['super_admin', 'admin'])) return false;

                if ($user->cant('update_article')) {
                    if ($user->cant('review_article')) {
                        return true;
                    }
                }

                if ($record->author_id !== $user->id) {
                    return true;
                }
            })
            ->icon('heroicon-s-eye')
            ->iconButton()
            ->tooltip('View')
            ->fillForm(fn (Article $record): array => [
                'title' => $record->title,
                'short_title' => $record->short_title,
                'subject' => $record->topic->name,
                'section' => $record->topicSection->name ?? '',
                'subSection' => $record->topicSubSection->name ?? '',
                'author' => $record->author->name,
                'reviewer' => $record->reviewer->name ?? '',
                'tags' => $record->tags,
                'body' => $record->latestReview()->review ?? 'No reviewer comments available on this article.',
                'content' => $record->content->content ?? '',
                'sources' => $record->sources
            ])
            ->form([
                TextInput::make('title')->disabled(),
                TextInput::make('short_title')->disabled(),
                Group::make()->schema([
                    TextInput::make('subject')->disabled(),
                    TextInput::make('section')->disabled(),
                    TextInput::make('subSection')->disabled(),
                ])->columns(3),
                SpatieTagsInput::make('tags')->placeholder('')->disabled(),
                Group::make()->schema([
                    TextInput::make('author')->disabled(),
                    TextInput::make('reviewer')->disabled(),
                ])->columns(),
                CKEditor::make('content')
                    ->disabled()
                    ->columnSpanFull(),

                RichEditor::make('body')
                    ->label('Review Comments')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                    ])->disabled(),

                SourceInput::make('sources')->disabled()
            ])->slideOver();
    }
}
