@php
    $statePath = $getStatePath();
@endphp
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <style>
        .ck-editor-container {
            display: flex;
            width: 100%;
        }
        .ck-editor__editable {
            min-height: 500px; /* Adjust the height as needed */
        }

        .ck-editor__editable ul {
            margin-left: 25px;
        }

        .ck-editor__editable ol {
            margin-left: 25px;
        }
        .ck.ck-toolbar.ck-toolbar_grouping>.ck-toolbar__items{
            flex-wrap: wrap !important;
        }
    </style>

    <div
        wire:ignore
        x-ignore
        ax-load
        x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('ckeditor'))]"
        ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('ck-editor-component') }}"
        x-data="ckEditorComponent({ state: $wire.{{ $applyStateBindingModifiers("entangle('{$statePath}')", isOptimisticallyLive: false) }} })"
        class="ck-editor-container"
    >
        <textarea x-ref="editor" hidden></textarea>
    </div>

</x-dynamic-component>
