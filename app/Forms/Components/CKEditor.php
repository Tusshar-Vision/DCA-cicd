<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasExtraAlpineAttributes;

class CKEditor extends Field
{
    use HasExtraAlpineAttributes;

    protected string $view = 'forms.components.c-k-editor';

    protected function setUp(): void
    {
        parent::setUp();
        $this->default('');
        $this->hiddenLabel();
    }
}
