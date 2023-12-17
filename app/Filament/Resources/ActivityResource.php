<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Filament\Resources\ActivityResource\RelationManagers;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityResource extends \Z3d0X\FilamentLogger\Resources\ActivityResource
{
    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return config('filament-logger.nav.group');
    }
}
