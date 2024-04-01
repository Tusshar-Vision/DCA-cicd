export default function ckEditorComponent({
    state
}, disabled) {
    const component = this;

    return {
        state,

        // You can define any other Alpine.js properties here.

        init: function () {
            // Initialise the Alpine component here, if you need to.
            ClassicEditor.create(this.$refs.editor,
                {
                    extraPlugins: [SimpleUploadAdapterPlugin],
                    toolbar: {
                        items: [
                            "undo", "redo",
                            {
                                label: 'Tools',
                                icon: 'threeVerticalDots',
                                items: [ "findAndReplace", "removeFormat", "selectAll" ]
                            },
                            "|", "heading", "fontSize",
                            {
                                label: 'Styles',
                                icon: '<svg viewBox="0 0 68 64" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M43.71 11.025a11.508 11.508 0 0 0-1.213 5.159c0 6.42 5.244 11.625 11.713 11.625.083 0 .167 0 .25-.002v16.282a5.464 5.464 0 0 1-2.756 4.739L30.986 60.7a5.548 5.548 0 0 1-5.512 0L4.756 48.828A5.464 5.464 0 0 1 2 44.089V20.344c0-1.955 1.05-3.76 2.756-4.738L25.474 3.733a5.548 5.548 0 0 1 5.512 0l12.724 7.292z" fill="#FFF"/><path d="M45.684 8.79a12.604 12.604 0 0 0-1.329 5.65c0 7.032 5.744 12.733 12.829 12.733.091 0 .183-.001.274-.003v17.834a5.987 5.987 0 0 1-3.019 5.19L31.747 63.196a6.076 6.076 0 0 1-6.037 0L3.02 50.193A5.984 5.984 0 0 1 0 45.003V18.997c0-2.14 1.15-4.119 3.019-5.19L25.71.804a6.076 6.076 0 0 1 6.037 0L45.684 8.79zm-29.44 11.89c-.834 0-1.51.671-1.51 1.498v.715c0 .828.676 1.498 1.51 1.498h25.489c.833 0 1.51-.67 1.51-1.498v-.715c0-.827-.677-1.498-1.51-1.498h-25.49.001zm0 9.227c-.834 0-1.51.671-1.51 1.498v.715c0 .828.676 1.498 1.51 1.498h18.479c.833 0 1.509-.67 1.509-1.498v-.715c0-.827-.676-1.498-1.51-1.498H16.244zm0 9.227c-.834 0-1.51.671-1.51 1.498v.715c0 .828.676 1.498 1.51 1.498h25.489c.833 0 1.51-.67 1.51-1.498v-.715c0-.827-.677-1.498-1.51-1.498h-25.49.001zm41.191-14.459c-5.835 0-10.565-4.695-10.565-10.486 0-5.792 4.73-10.487 10.565-10.487C63.27 3.703 68 8.398 68 14.19c0 5.791-4.73 10.486-10.565 10.486v-.001z" fill="#1EBC61" fill-rule="nonzero"/><path d="M60.857 15.995c0-.467-.084-.875-.251-1.225a2.547 2.547 0 0 0-.686-.88 2.888 2.888 0 0 0-1.026-.531 4.418 4.418 0 0 0-1.259-.175c-.134 0-.283.006-.447.018-.15.01-.3.034-.446.07l.075-1.4h3.587v-1.8h-5.462l-.214 5.06c.319-.116.682-.21 1.089-.28.406-.071.77-.107 1.088-.107.218 0 .437.021.655.063.218.041.413.114.585.218s.313.244.422.419c.109.175.163.391.163.65 0 .424-.132.745-.396.961a1.434 1.434 0 0 1-.938.325c-.352 0-.656-.1-.912-.3-.256-.2-.43-.453-.523-.762l-1.925.588c.1.35.258.664.472.943.214.279.47.514.767.706.298.191.63.339.995.443.365.104.749.156 1.151.156.437 0 .86-.064 1.272-.193.41-.13.778-.323 1.1-.581a2.8 2.8 0 0 0 .775-.981c.193-.396.29-.864.29-1.405h-.001z" fill="#FFF" fill-rule="nonzero"/></g></svg>',
                                items: [ 'bold', 'italic', "underline", 'strikethrough', 'superscript', 'subscript' ]
                            },
                            "|", {
                                label: 'Text Formatting',
                                icon: 'text',
                                items: [ "fontColor", "fontBackgroundColor", "highlight" ]
                            },
                            "|", "alignment", "link",
                            {
                                label: 'Lists',
                                icon: false,
                                items: [ 'bulletedList', 'numberedList', 'todoList' ]
                            },
                            {
                                // A "plus" sign icon works best for content insertion tools.
                                label: 'Insert',
                                icon: 'plus',
                                items: [ "insertTable", "imageInsert", "mediaEmbed", "blockQuote", "specialCharacters", "horizontalLine" ]
                            },
                            "|", "outdent", "indent",
                        ]
                    },
                    language: "en",
                    image: {toolbar: ["imageTextAlternative", "toggleImageCaption", "imageStyle:inline", "imageStyle:block", "imageStyle:side"]},
                    table: {contentToolbar: ["tableColumn", "tableRow", "mergeTableCells", "tableCellProperties", "tableProperties"]},
                    mediaEmbed: {previewsInData: true},
                    autosave: {
                        waitingTime: 1000,
                        save: (editor) => {
                            return new Promise((resolve) => {
                                this.state = editor.getData();
                                resolve();
                            });
                        }
                    },
                })
                .then(editor => {
                    displayStatus( editor );
                    editor.setData(this.state ?? '');
                    const wordCountPlugin = editor.plugins.get( 'WordCount' );
                    const wordCountWrapper = document.getElementById( 'word-count' );

                    wordCountWrapper.appendChild( wordCountPlugin.wordCountContainer );

                    if (disabled) {
                        editor.enableReadOnlyMode( 'my-feature-id' );
                    }

                    const prefersDark = document.querySelector('html').classList.contains('dark');
                    const editorDiv = document.querySelector('.ck-editor');
                    const statusBar = document.querySelector('#snippet-autosave-header');

                    if (prefersDark === true) {
                        editorDiv.classList.add('ck-custom-dark-mode');
                        statusBar.classList.add('ck-custom-dark-mode');
                    }
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

// Update the "Status: Saving..." information.
function displayStatus( editor ) {
    const pendingActions = editor.plugins.get( 'PendingActions' );
    const statusIndicator = document.querySelector( '#snippet-autosave-status' );

    pendingActions.on( 'change:hasAny', ( evt, propertyName, newValue ) => {
        if ( newValue ) {
            statusIndicator.classList.add( 'busy' );
        } else {
            statusIndicator.classList.remove( 'busy' );
        }
    } );
}
