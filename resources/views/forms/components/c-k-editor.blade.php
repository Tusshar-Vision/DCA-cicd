@php
    $statePath = $getStatePath();
@endphp
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <style>
        .ck-editor__editable {
            min-height: 500px; /* Adjust the height as needed */
        }

        .ck-editor__editable ul {
            margin-left: 25px;
        }

        .ck-editor__editable ol {
            margin-left: 25px;
        }
    </style>

    <div
        wire:ignore
        x-ignore
        ax-load
        ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('ck-editor-component') }}"
        x-data="ckEditorComponent({ state: $wire.{{ $applyStateBindingModifiers("entangle('{$statePath}')", isOptimisticallyLive: false) }} })"
    >
        <textarea x-ref="editor" hidden></textarea>
    </div>

</x-dynamic-component>
