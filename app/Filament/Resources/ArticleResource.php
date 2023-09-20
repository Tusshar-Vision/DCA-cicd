<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use App\Models\InitiativeTopic;
use Filament\Actions\SelectAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->columnSpanFull(),

                Select::make('initiative_topic_id')->options(
                    InitiativeTopic::all()->pluck('name', 'id')
                )->required()->label('Topic'),
                
                Select::make('language')->options([
                    "hindi" => "Hindi",
                    "english" => "English",
                ])->required()->default('english'),
                
                FileUpload::make('featured_image'),
                
                TagsInput::make('tags')->required()->suggestions(
                    Article::whereNotNull('tags') // Filter out articles with NULL tags
                    ->get()
                    ->flatMap(function ($article) {
                        return $article->tags;
                    })
                    ->unique()
                    ->values()
                    ->toArray()  
                ),
                
                MarkdownEditor::make('content')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Article ID'),
                TextColumn::make('updated_at')->dateTime('d M Y h:m')->label('Last Updated')->sortable(),
                TextColumn::make('title'),
                TextColumn::make('status'),
                TextColumn::make('initiative.name'),
                TextColumn::make('topic.name')->label('Topic'),
                TextColumn::make('tags')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }    
}
