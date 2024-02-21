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
        .ck-editor__editable {
            min-height: 500px; /* Adjust the height as needed */
        }

        #editor ul {
            margin-left: 15px;
        }

        #editor ol {
            margin-left: 15px;
        }

    </style>
    <div
        id="editor"
        x-data="{
            init() {
                // Initialize CKEditor
                ClassicEditor.create(this.$refs.editor,  {
                        extraPlugins: [SimpleUploadAdapterPlugin],
                    })
                    .then(editor => {
                        // Set initial data
                        editor.setData(@js($this->data['content']['content'] ?? ''));

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

            <script>
                class SimpleUploadAdapter {
                    constructor(loader) {
                        this.loader = loader;
                    }

                    upload() {
                        return this.loader.file
                            .then(file => new Promise((resolve, reject) => {
                                const formData = new FormData();
                                formData.append('upload', file);

                                fetch('/upload', { // Laravel endpoint for file upload
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                                    },
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.uploaded) {
                                            resolve({
                                                default: data.url // URL to uploaded file
                                            });
                                        } else {
                                            reject(data.error.message);
                                        }
                                    })
                                    .catch(reject);
                            }));
                    }
                }

                function SimpleUploadAdapterPlugin(editor) {
                    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                        return new SimpleUploadAdapter(loader);
                    };
                }
            </script>
        @endpush
    @endonce
</x-dynamic-component>
