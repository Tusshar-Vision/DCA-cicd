export default function ckEditorComponent({
    state,
}) {
    return {
        state,

        // You can define any other Alpine.js properties here.

        init: function () {
            // Initialise the Alpine component here, if you need to.
            ClassicEditor.create(this.$refs.editor, {
                extraPlugins: [SimpleUploadAdapterPlugin],
            })
                .then(editor => {
                    editor.setData(this.state ?? '');

                    // Listen for changes in the editor and update Livewire data
                    editor.model.document.on('change:data', () => {
                        this.state = editor.getData();
                    });
                })
                .catch(error => console.error(error));
        },

    // You can define any other Alpine.js functions here.
    }
}

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
