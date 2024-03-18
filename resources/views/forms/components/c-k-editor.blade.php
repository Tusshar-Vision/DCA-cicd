@php
    $statePath = $getStatePath();
    $disabled = $isDisabled();
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
        #snippet-autosave-header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--ck-color-toolbar-background);
            border: 1px solid var(--ck-color-toolbar-border);
            padding: 10px;
            border-radius: var(--ck-border-radius);
            /*margin-top: -1.5em;*/
            margin-bottom: 1.5em;
            border-top: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        #snippet-autosave-status_spinner {
            display: flex;
            align-items: center;
            position: relative;
        }

        #snippet-autosave-status_spinner-label {
            position: relative;
        }

        #snippet-autosave-status_spinner-label::after {
            content: 'Saved!';
            color: green;
            display: inline-block;
            margin-right: var(--ck-spacing-medium);
        }

        /* During "Saving" display spinner and change content of label. */
        #snippet-autosave-status.busy #snippet-autosave-status_spinner-label::after {
            content: 'Saving...';
            color: red;
        }

        #snippet-autosave-status.busy #snippet-autosave-status_spinner-loader {
            display: block;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border-top: 3px solid hsl(0, 0%, 70%);
            border-right: 2px solid transparent;
            animation: autosave-status-spinner 1s linear infinite;
        }

        #snippet-autosave-status,
        #snippet-autosave-server {
            display: flex;
            align-items: center;
        }

        #snippet-autosave-server_label,
        #snippet-autosave-status_label {
            font-weight: bold;
            margin-right: var(--ck-spacing-medium);
        }

        #snippet-autosave + .ck.ck-editor .ck-editor__editable {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        #snippet-autosave-lag {
            padding: 4px;
        }

        #snippet-autosave-console {
            max-height: 300px;
            overflow: auto;
            white-space: normal;
            background: #2b2c26;
            transition: background-color 500ms;
        }

        #snippet-autosave-console.updated {
            background: green;
        }

        @keyframes autosave-status-spinner {
            to {
                transform: rotate( 360deg );
            }
        }

        .hidden {
            display: none !important;
        }
    </style>

    <div
        wire:ignore
        x-ignore
        ax-load
        x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('ckeditor'))]"
        x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('ckeditor-css'))]"
        ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('ck-editor-component') }}"
        x-data="ckEditorComponent(
            { state: $wire.{{ $applyStateBindingModifiers("entangle('{$statePath}')", isOptimisticallyLive: false) }} },
            {{ $disabled }}
        )"
    >
        <textarea x-ref="editor" hidden></textarea>
        <div id="snippet-autosave-header" class="{{ $disabled ? 'hidden' : '' }}">
            <div id="snippet-autosave-status">
                <div id="snippet-autosave-status_label">Status:</div>
                <div id="snippet-autosave-status_spinner">
                    <span id="snippet-autosave-status_spinner-label"></span>
                    <span id="snippet-autosave-status_spinner-loader"></span>
                </div>
            </div>
        </div>
    </div>

</x-dynamic-component>
