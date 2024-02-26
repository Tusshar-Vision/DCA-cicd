<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\InfographicsResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\Infographic;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class InfographicsResource extends Resource
{
    protected static ?string $model = Infographic::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Media';

    protected static ?string $label = 'Infographic';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([

                    Group::make()->schema([

                        Forms\Components\TextInput::make('title')->required(),

                        Select::make('initiative_topic_id')
                            ->relationship('topic', 'name')
                            ->required()
                            ->label('Subject')
                            ->reactive()->afterStateUpdated(function (Set $set, ?string $state) {
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

                    Forms\Components\SpatieMediaLibraryFileUpload::make('Infographic')
                        ->id('infographic')
                        ->collection('infographic')
                        ->required()
                        ->visibility('private')
                        ->visible(function (?Infographic $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer'])) return true;
                            else if ($record !== null && $record->hasMedia('infographic')) return true;
                            else return false;
                        })
                        ->openable()
                        ->deletable(function (?Infographic $record) {
                            if ($record !== null && $record->is_published === true) {
                                return Auth::user()->hasAnyRole(['admin', 'super_admin']);
                            } else {
                                return Auth::user()->hasAnyRole(['admin', 'super_admin', 'reviewer']);
                            }
                        })
                        ->acceptedFileTypes([
                            'application/pdf',
                            'image/jpeg',
                            'image/png',
                            'image/svg'
                        ]),

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
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip('Edit')
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->tooltip('Delete')
                    ->visible(function(Infographic $record) {
                        return $record->publishedInitiatives()->count() === 0;
                    })
                    ->iconButton()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInfographics::route('/'),
            'create' => Pages\CreateInfographics::route('/create'),
            'edit' => Pages\EditInfographics::route('/{record}/edit'),
        ];
    }
}
