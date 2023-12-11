<div class="vi-modal-wrap">
    <div class="vi-modal-inner">
        <div class="vi-modal-content">
            <div class="edit-text">
                <blockquote contenteditable="true">
                    <p id="note-title">{{ $article->title }}</p>
                </blockquote>
                <a href="#" class="edit-title"><img src="{{ URL::asset('images/edit.png') }}"></a>
            </div>
            <div class="vi-tinymce-editor">
                <textarea id="notes-text-area" style="width: 100%; resize: none;">
                    {!! $note?->content !!}
                </textarea>
            </div>
            <div class="added-tags my-3">
                <span>Article 72<a href="#">x</a></span>
            </div>
            <div class="tag-wrap">
                <div class="tags">
                    @foreach ($article->tags as $tag)
                        <span>{{ $tag->name }}</span>
                    @endforeach
                </div>
                <div class="search-tags">
                    <input type="search" placeholder="Search">
                    <div class="search-list overflow-scroll" style="display: none;">
                        <p>Search 1</p>
                        <p>Search 2</p>
                        <p>Search 3</p>
                        <p>Search 2</p>
                        <p>Search 3</p>
                        <p>Search 2</p>
                        <p>Search 3</p>
                    </div>
                </div>
            </div>
            <div class="vi-modal-action">
                <a href="#" class="vi-secondary-button">Cancel</a>
                <a href="#" class="vi-primary-button" @click="isNoteOpen=false" onclick="saveNote()">Save Note</a>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea#notes-text-area', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        menubar: false,
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });

    function saveNote() {
        const user_id = {{ Auth::user()->id }};
        const article_id = "{{ $article->id }}";
        const topic_id = "{{ $article->topic->id }}";
        const topic_section_id = "{{ $article->topic_section_id }}";
        const topic_sub_section_id = "{{ $article->topic_sub_section_id }}";
        const note = tinyMCE.activeEditor.getContent();
        const note_title = document.getElementById("note-title").innerHTML

        postJSON({
            user_id,
            article_id,
            topic_id,
            topic_section_id,
            topic_sub_section_id,
            note_title,
            note,
            _token: '{{ csrf_token() }}'
        });

        // getNotes()
    }

    async function postJSON(data) {
        try {
            const response = await fetch("{{ route('notes.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });

            console.log("Response", response);

            const result = await response.json();
            console.log("Success:", result);
        } catch (error) {
            console.error("Error:", error);
        }
    }

    // getNotes();
    // tinymce.get('notes-text-area').setContent('<p>adsf</p>');
    // async function getNotes() {
    //     const response = await fetch("{{ route('notes.of-article', ['article_id' => $article->id]) }}");
    //     const notes = await response.json();
    //     console.log("notes from add note", notes);
    //     if (notes) {
    //         console.log("here");
    //         tinymce.get('notes-text-area').setContent('<p>adsf</p>');
    //     }

    //     document.querySelectorAll(".copy-link").forEach((copyLinkParent) => {
    //         const inputField = copyLinkParent.querySelector(".copy-link-input");
    //         const copyButton = copyLinkParent.querySelector(".copy-link-button");
    //         const text = inputField.value;

    //         inputField.addEventListener("focus", () => inputField.select());

    //         copyButton.addEventListener("click", () => {
    //             console.log("Hi");
    //             inputField.select();
    //             navigator.clipboard.writeText(text);

    //             inputField.value = "Copied!";
    //             setTimeout(() => (inputField.value = text), 2000);
    //         });
    //     });
    // }
</script>
