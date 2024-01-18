<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\AnnouncementResource\Pages;
use App\Filament\Resources\AnnouncementResource\RelationManagers;
use App\Helpers\InitiativesHelper;
use App\Models\Announcement;
use Carbon\Carbon;
use DateTimeZone;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PHPUnit\Metadata\Group;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->description('Announcements will be visible to users in the Announcements Section on Home Page')
                    ->schema([
                        Fieldset::make('Announcement Controls')->schema([
                            Toggle::make('is_visible')
                                ->default(true)
                                ->inline(false)
                                ->live(),
                            Forms\Components\Group::make()->schema([
                                DatePicker::make('visible_till')
                                    ->native(false)
                                    ->closeOnDateSelection()
                                    ->default(Carbon::tomorrow())
                                    ->after('published_at')
                                    ->required(),
                                DateTimePicker::make('published_at')
                                    ->native(false)
                                    ->displayFormat('M d, Y h:i')
                                    ->id('publish_at')
                                    ->label('Automatically Publish At')
                                    ->default(Carbon::now())
                                    ->visible(function (callable $get) {
                                        return !$get('is_visible');
                                    })
                                    ->reactive()
                                    ->required(),

                                Hidden::make('published_at')
                                    ->default(function (Forms\Get $get) {
                                        return $get('publish_at');
                                    }),

                                Hidden::make('user_id')->default(\Auth::user()->id)
                            ])
                        ])->columnSpan(1),

                        Fieldset::make('Notification Message')->schema([
                            RichEditor::make('content')->label('')->columnSpanFull()->toolbarButtons([
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])->required(),
                        ])->columnSpan(1)
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->columns([
                self::showVisibleColumn(\Auth::user()),
                TextColumn::make('visible_till')->label('Will be Visible Till')->date(),
                TextColumn::make('published_at')->label('Publish At')->date('M d, Y, h:i a'),
                Tables\Columns\ImageColumn::make('Created By')
                    ->alignCenter()
                    ->defaultImageUrl(function (Model $record) {
                        $first_initial = mb_substr($record->author->name, 0, 1);
                        return 'https://ui-avatars.com/api/?name=' . $first_initial . '&color=FFFFFF&background=09090b';
                    })
                    ->circular()
                    ->tooltip(function (Model $record) {
                        return $record->author->name;
                    })
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('View')
                    ->icon('heroicon-s-eye')
                    ->tooltip('View')
                    ->iconButton()
                    ->form(function (Model $record) {
                        return [
                            RichEditor::make('content')
                                ->default($record->content)
                                ->label('')
                                ->columnSpanFull()
                                ->toolbarButtons([
                                    'bold',
                                    'bulletList',
                                    'italic',
                                    'link',
                                    'orderedList',
                                    'redo',
                                    'strike',
                                    'underline',
                                    'undo',
                            ])->required(),
                        ];
                })->action(function (Model $record, $data) {
//                    $record->update(['content' => $data['content']]);
                    }),
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->tooltip('Edit')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    private static function showVisibleColumn($user) {
        if ($user->can('edit_announcement')) {
            return ToggleColumn::make('is_visible')
                ->alignCenter()
                ->label('Is Visible');
        } else {
            return IconColumn::make('is_visible')
                ->alignCenter()
                ->name('is_visible')
                ->boolean()
                ->label('Is Visible');
        }
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('author')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
