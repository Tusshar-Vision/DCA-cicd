<?php

namespace App\Forms\Components;

use Closure;
use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasExtraAlpineAttributes;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class CKEditor extends Field
{
    use HasExtraAlpineAttributes;

    protected string $view = 'forms.components.c-k-editor';

    protected function setUp(): void
    {
        parent::setUp();
        $this->hiddenLabel();

        $this->afterStateHydrated(function (CKEditor $component, string | array | null $state): void {

            if (! $state) {
                return;
            }

            $component->state($state);
        });

        $this->afterStateUpdated(function (CKEditor $component, Component $livewire): void {
            $livewire->validateOnly($component->getStatePath());
        });

        $this->dehydrateStateUsing(function (CKEditor $component, string | array | null $state): string | array | null {

            if (! $state) {
                return null;
            }

            return $state;
        });
    }
}
