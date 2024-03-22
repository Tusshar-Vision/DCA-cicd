<?php

namespace App\Filament\Resources\WeeklyFocusResource\Pages;

use App\Filament\Resources\WeeklyFocusResource;
use App\Models\InitiativeTopic;
use App\Models\TopicSection;
use App\Models\TopicSubSection;
use Filament\Actions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class EditWeeklyFocus extends EditRecord
{
    protected static string $resource = WeeklyFocusResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\Action::make('Set Featured'),
        ];
    }
}
