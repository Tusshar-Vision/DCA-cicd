<?php

namespace App\Traits\Filament\Components;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\User;
use Auth;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Livewire\Component as Livewire;

trait ExpertReviewColumn
{
    public static function getPermission($initiative_id): string {
        return match($initiative_id) {
            InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY) => 'assign_news::today',
            InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS) => 'assign_weekly::focus',
            InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE) => 'assign_monthly::magazine',
            default => throw new \Exception("Permission not defined for resource."),
        };
    }

    public function getExpertColumn(bool $canAssignArticle)
    {
        if ($canAssignArticle === false) {
            return TextColumn::make('author.name')
                ->searchable()
                ->label('Expert')
                ->toggleable();
        }

        return SelectColumn::make('author_id')
                ->label('Current Assigned Expert')
                ->searchable()
                ->default(function (Article $record) {
                    return $record->author_id;
                })
                ->toggleable()
                ->options(function (Livewire $livewire, Article $article) {
                    $initiative_id = $livewire->ownerRecord?->initiative_id ?? $article->initiative_id;
                    $roles = collect(['expert', 'admin', 'super_admin']);

                    if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY)) {
                        $roles->add('news_today_expert');
                    } else if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)) {
                        $roles->add('weekly_focus_expert');
                    } else if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE)) {
                        $roles->add('monthly_magazine_expert');
                    }

                    return User::whereHas('roles', function ($query) use ($roles) {
                        $query->whereIn('name', $roles->toArray());
                    })->get()->pluck('name', 'id');
                })
                ->disabled(function (Article $record) {
                    if ($record->status === 'Final' || $record->status === 'Published') return true;
                    if (Auth::user()->can(self::getPermission($record->initiative_id))) return false;
                    else return true;
                });

    }

    public function getReviewColumn(bool $canAssignArticle) {
        if ($canAssignArticle === false) {
            return TextColumn::make('reviewer.name')
                ->searchable()
                ->label('Reviewer')
                ->toggleable();
        }

        return SelectColumn::make('reviewer_id')
            ->label('Current Assigned Reviewer')
            ->searchable()
            ->default(function (Article $record) {
                return $record->reviewer_id;
            })
            ->toggleable()
            ->options(function (Livewire $livewire, Article $article) {
                $initiative_id = $livewire->ownerRecord?->initiative_id ?? $article->initiative_id;
                $roles = collect(['reviewer', 'admin', 'super_admin']);

                if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY)) {
                    $roles->add('news_today_reviewer');
                } else if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)) {
                    $roles->add('weekly_focus_reviewer');
                } else if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE)) {
                    $roles->add('monthly_magazine_reviewer');
                }

                return User::whereHas('roles', function ($query) use ($roles) {
                    $query->whereIn('name', $roles->toArray());
                })->get()->pluck('name', 'id');
            })
            ->disabled(function (Article $record) {
                if ($record->status === 'Final' || $record->status === 'Published') return true;
                if (Auth::user()->can(self::getPermission($record->initiative_id))) return false;
                else return true;
            });
    }
}
