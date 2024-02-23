<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Resources\Pages\EditRecord;


class EditArticle extends EditRecord
{

    public string $content = '';

    protected $listeners = ['editorInput' => 'handleEditorInput'];

    protected static string $resource = ArticleResource::class;

    public function handleEditorInput($content): void
    {
        $this->content = $content;
    }

    public function beforeSave() {
        $this->record->content->content = $this->content;
        $this->record->content->save();
    }
    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }
}
