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
            <div class="added-tags my-3" id="note-tag">
                @isset($note)
                    @foreach ($note->tags as $tag)
                        <span class="tag-name">{{ $tag->name }}<a href="#">x</a></span>
                    @endforeach
                @endisset
            </div>
            <div class="tag-wrap">
                <div class="tags" id="article-tag">
                    @foreach ($article->tags as $tag)
                        <span
                            onclick="{{ isset($note) ? "addTagToNote('$tag->name')" : '' }}">{{ $tag->name }}</span>
                    @endforeach
                </div>
                <div class="search-tags">
                    <input type="search" placeholder="Search" oninput="searchTags(this)">
                    <div id="search-item-container" class="search-list overflow-scroll" style="display: none;">
                        <p>Search 1</p>
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

<script>
    tinymce.init({
        selector: 'textarea#notes-text-area',
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

        saveData("{{ route('notes.add') }}", {
            user_id,
            article_id,
            topic_id,
            topic_section_id,
            topic_sub_section_id,
            note_title,
            note,
            _token: '{{ csrf_token() }}'
        }).then(data => {
            tinymce.get('notes-text-area').setContent(data.data.content)
        })
    }

    function addTagToNote(tag, click_from = null) {
        const tagContainer = document.getElementById("note-tag");
        saveData("{{ route('notes.add-tag', ['note_id' => $note->id]) }}", {
            tag,
            _token: '{{ csrf_token() }}'
        }).then(data => {
            if (data.status === 201) tagContainer.innerHTML +=
                `<span class="mr-2">${data.data}<a href="#">x</a></span>`
        })

        if (click_from == 'search') document.getElementById("search-item-container").style.display = "none"
    }

    function searchTags(el) {
        const url = "{{ url('tags') }}" + "/" + el.value;
        getData(url).then(data => {
            let html = "";
            data.data.map(item => {
                html += `<p onclick="addTagToNote('${item}', 'search')">${item}</p>`
            })
            document.getElementById("search-item-container").innerHTML = html;
            document.getElementById("search-item-container").style.display = "block"
        })
    }
</script>
