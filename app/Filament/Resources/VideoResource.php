<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationGroup = 'Media';

    protected static ?string $label = 'Video';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([

                    Group::make()->schema([

                        TextInput::make('title')->required(),

                        Textarea::make('description')->label('Description'),

                        Select::make('initiative_topic_id')
                            ->relationship('topic', 'name')
                            ->required()
                            ->label('Subject')
                            ->reactive()
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('topic_section_id', null);
                                $set('topic_sub_section_id', null);
                            }),

                        Select::make('topic_section_id')
                            ->relationship('topicSection', 'name', function ($query, callable $get) {
                                $topic = $get('initiative_topic_id');

                                return $query->where('topic_id', '=', $topic);
                            })
                            ->reactive()
                            ->label('Section')
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('topic_sub_section_id', null);
                            }),

                        Select::make('topic_sub_section_id')
                            ->relationship('topicSubSection', 'name', function ($query, callable $get) {
                                $topicSectionId = $get('topic_section_id');

                                return $query->where('section_id', '=', $topicSectionId);
                            })
                            ->reactive()
                            ->label('Sub Section'),

                    ])->columns(1),

                ])->columnSpan(1),

                Section::make()->schema([

                    Toggle::make('is_url')
                        ->label('Provide URL')
                        ->reactive(),

                    SpatieMediaLibraryFileUpload::make('Video')
                        ->hidden(function (callable $get) {
                            return $get('is_url');
                        })
                        ->id('video')
                        ->collection('video')
                        ->required()
                        ->acceptedFileTypes([
                            'video/mp4',         // MP4 videos
                            'video/webm',        // WebM videos
                            'video/ogg',
                        ])
                        ->previewable(),

                    TextInput::make('url')
                        ->visible(function (callable $get) {
                            return $get('is_url');
                        })
                        ->label('Video URL')
                        ->required()
                        ->activeUrl(true),

                    Group::make()->schema([

                        Select::make('language_id')
                            ->relationship('language', 'name', function ($query) {
                                return $query->orderBy('order_column');
                            })
                            ->label('Language')
                            ->required()
                            ->default(1),

                        SpatieTagsInput::make('tags')
                            ->required(),

                    ])->columns(1),

                    Hidden::make('author_id')->default(function () {
                        return Auth::user()->id;
                    })

                ])->columnSpan(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->label('id'),
                TextColumn::make('title')
                    ->limit(40)
                    ->tooltip(fn (Model $record): string => $record->title)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('topic.name')
                    ->label('Subject')
                    ->searchable(),
                TextColumn::make('topicSection.name')
                    ->label('Section')
                    ->limit(20)
                    ->tooltip(fn (Model $record): string => $record->topicSection->name ?? '')
                    ->searchable(),
                TextColumn::make('topicSubSection.name')
                    ->label('Sub-Section')
                    ->limit(20)
                    ->tooltip(fn (Model $record): string => $record->topicSubSection->name ?? '')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                SpatieTagsColumn::make('tags')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Last Modified')
                    ->date('d M Y h:i a')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\Action::make('View')
//                    ->icon('heroicon-s-eye')
//                    ->tooltip('Preview')
//                    ->iconButton(),
                Tables\Actions\EditAction::make()
                    ->tooltip('Edit')
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
