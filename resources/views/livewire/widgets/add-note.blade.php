<div class="vi-modal-wrap">
    <div class="vi-modal-inner">
        <div class="vi-modal-content">
            <div class="edit-text border p-[15px] bg-white">
                <blockquote contenteditable="false">
                    <p id="note-title" class="font-black">{{ $article->title }}</p>
                </blockquote>
                <img onclick="editTitle()" src="{{ URL::asset('images/edit.png') }}">
            </div>
            <div class="vi-tinymce-editor border border-t-0 p-[15px] bg-white">
                <textarea id="notes-text-area" style="width: 100%; resize: none;">
                    {!! $note?->content !!}
                </textarea>
            </div>
            <div class="added-tags my-3" id="note-tag">
                @isset($note)
                    @foreach ($note->tags as $tag)
                        <span id="{{ $tag->name }}span" class="mr-2 mb-2"><span class="tag-name">{{ $tag->name }}<a
                                    href="javascript:void(0)"><img id="{{ $tag->name }}"
                                        src="{{ URL::asset('images/remove-tag.png') }}"></a></span></span>
                    @endforeach
                @endisset
            </div>
            <div class="tag-wrap">
                <div class="tags" id="article-tag">
                    @foreach ($article->tags as $tag)
                        <span class="note-tag-name"
                            onclick="addTagToNote('{{ $tag->name }}')">{{ $tag->name }}</span>
                    @endforeach
                </div>
                <div class="search-tags relative">
                    <input type="search" placeholder="Search" oninput="searchTags(this)">
                    <div id="search-item-container" class="search-list overflow-scroll" style="display: none;">
                        <p>Search 1</p>
                    </div>
                </div>
            </div>
            <div class="vi-modal-action">
                <a href="#" class="vi-secondary-button" @click="isNoteOpen=false">Cancel</a>
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
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        setup: function(editor) {
            editor.on('init', function() {
                loadForLocalStorage()
            });
        }
    });

        // edit content
    function toggleContentEditable() {
        console.log('HI');
        var blockquote = document.getElementById('myBlockquote');
        var currentValue = blockquote.getAttribute('contenteditable');

        // Toggle the attribute value
        if (currentValue === 'false') {
            blockquote.setAttribute('contenteditable', 'true');
        } else {
            blockquote.setAttribute('contenteditable', 'false');
        }
    }

    window.onload = loadForLocalStorage;

    function loadForLocalStorage() {
        const article_id = "{{ $article->getID() }}";
        <?php if(!Auth::check()) { ?>
        if (localStorage.getItem('notes')) {
            const notes = JSON.parse(localStorage.getItem('notes'));
            const note = notes.find(note => note.article_id == article_id)
            if (note) {
                tinymce.get('notes-text-area').setContent(note.note);
            }
        }
        <?php } ?>
    }

    function editTitle() {
        document.querySelector("[contenteditable=false]").setAttribute('contenteditable', true)
    }

    function saveNote() {
        const tagsNodes = document.querySelectorAll('.tag-name');
        let tags = [];
        for (let i = 0; i < tagsNodes.length; i++) tags.push(tagsNodes[i].innerText)
        @if (Auth::check())
            const user_id = "{{ Auth::check() ? Auth::user()->id : '' }}";
        @endif
        const article_id = "{{ $article->getID() }}";
        const topic_id = "{{ $article->getTopicID() }}";
        const topic_section_id = "{{ $article->getSectionID() }}";
        const topic_sub_section_id = "{{ $article->getSubSectionID() }}";
        const note = tinyMCE.activeEditor.getContent();
        const note_title = document.getElementById("note-title").innerHTML

        @if (Auth::check())
            saveData("{{ route('notes.add') }}", {
                user_id,
                article_id,
                topic_id,
                topic_section_id,
                topic_sub_section_id,
                note_title,
                note,
                tags,
                _token: '{{ csrf_token() }}'
            }).then(data => {
                tinymce.get('notes-text-area').setContent(data.data.content)
            })
        @else
            console.log("unauthenticated");
            let notes;
            if (localStorage.getItem('notes')) {
                notes = JSON.parse(localStorage.getItem('notes'));
                const idx = notes.findIndex(note => note.article_id = article_id)
                if (idx != -1) {
                    notes[idx].note += note;
                    tinymce.get('notes-text-area').setContent(notes[idx].note)
                } else {
                    tinymce.get('notes-text-area').setContent(note)
                }
            } else {
                notes = []
                tinymce.get('notes-text-area').setContent(note)
            }
            notes.push({
                article_id,
                topic_id,
                topic_section_id,
                topic_sub_section_id,
                note_title,
                note,
                tags
            })
            localStorage.setItem("notes", JSON.stringify(notes));
        @endif
    }


    function addTagToNote(tag, click_from = null) {
        const tagsNodes = document.querySelectorAll('.tag-name');
        let tags = [];
        for (let i = 0; i < tagsNodes.length; i++) tags.push(tagsNodes[i].innerText)
        if (!tags.includes(tag)) {
            const tagContainer = document.getElementById("note-tag");
            tagContainer.innerHTML +=
                `<span id="{{ $tag->name }}span" class="mr-2 mb-2"><span class="tag-name">${tag}</span><a href="#">
                <img id="{{ $tag->name }}" src="{{ URL::asset('images/remove-tag.png') }}"></a></span>`;
        }
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
