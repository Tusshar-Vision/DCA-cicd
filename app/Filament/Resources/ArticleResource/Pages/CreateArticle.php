<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Guava\FilamentDrafts\Admin\Resources\Pages\Create\Draftable;

class CreateArticle extends CreateRecord
{
//    use Draftable;

    protected static string $resource = ArticleResource::class;
}
