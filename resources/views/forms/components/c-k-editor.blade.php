@php
    $statePath = $getStatePath();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    wire:ignore
>
    <style>
        #editor {
            height: 700px;
        }

        #editor ul {
            margin-left: 15px;
        }
    </style>
    <div
        id="editor"
        x-data="{
            init() {
                // Initialize CKEditor
                ClassicEditor.create(this.$refs.editor)
                    .then(editor => {
                        // Set initial data
                        editor.setData(@js($this->data['content']['content']));

                        // Listen for changes in the editor and update Livewire data
                        editor.model.document.on('change:data', () => {
                            this.$dispatch('editorInput', [editor.getData()]);
                        });
                    })
                    .catch(error => console.error(error));
            }
        }"
        wire:ignore
    >
        <textarea x-ref="editor" wire:model="data.title" hidden></textarea>
    </div>

    @once
        @push('scripts')
            <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
        @endpush
    @endonce
</x-dynamic-component>
