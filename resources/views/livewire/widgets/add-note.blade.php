<div class="vi-modal-wrap">
    <div class="vi-modal-inner">
        <div class="vi-modal-content">
            <div class="edit-text">
                <blockquote contenteditable="true">
                    <p id="note-title">{{ $article->title }}</p>
                </blockquote>
                <a href="#"><img src="{{ URL::asset('images/edit.png') }}"></a>
            </div>
            <div class="vi-tinymce-editor">
                <textarea id="notes-text-area" style="width: 100%; resize: none;"></textarea>
            </div>
            <div class="added-tags">
                <span>Article 72<a href="#">x</a></span>
            </div>
            <div class="tag-wrap">
                <div class="tags">
                    <span>Article 72</span>
                    <span>Article 72</span>
                    <span>Article 72</span>
                </div>
                <div class="search-tags">
                    <input type="search" placeholder="Search">
                </div>
            </div>
            <div class="vi-modal-action">
                <a href="#" class="vi-secondary-button">Cancel</a>
                <a href="#" class="vi-primary-button" onclick="saveNote()">Save Note</a>
            </div>
        </div>
    </div>
</div>

<script>
    function saveNote() {
        const user_id = "{{ Auth::user()->id }}";
        const article_id = "{{ $article->id }}";
        const topic_id = "{{ $article->topic->id }}";
        const topic_section_id = "{{ $article->topic_section_id }}";
        const topic_sub_section_id = "{{ $article->topic_sub_section_id }}";
        const note = document.getElementById("notes-text-area").value;
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

            const result = await response.json();
            console.log("Success:", result);
        } catch (error) {
            console.error("Error:", error);
        }
    }
</script>
