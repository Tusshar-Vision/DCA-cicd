<?php

namespace App\Filament\Resources\MonthlyMagazineResource\RelationManagers;

use App\Enums\Initiatives;
use App\Forms\Components\CKEditor;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Traits\Filament\ArticleRelationSchema;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component as Livewire;

class ShortArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'shortArticles';

    protected static ?string $title = 'News in Short';

    use ArticleRelationSchema;
}
