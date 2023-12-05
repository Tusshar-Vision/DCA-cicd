<div class="vi-modal-inner">
    <div class="vi-modal-content">
        <div class="vi-note">
            <div class="vi-card-corner">
                <div class="vi-card-corner-triangle"></div>
            </div>
            <p class="vi-note-title">Note 1</p>
            <div class="note-content">
                <p class="vi-text-light">A scelerisque purus semper eget duis. Dignissim cras tincidunt lobortis feugiat
                    vivamus at augue eget arcu.</p>
                <p class="vi-text-dark">Dignissim enim sit amet venenatis urna cursus eget nunc.</p>
            </div>
            <div class="vi-note-action">
                <a href="#" class="vi-icons note-delete"></a>
                <a href="#" class="vi-icons note-edit"></a>
            </div>
        </div>
        <div class="copylink-row tag-gap">
            <p>Current Affairs / blog-note4</p>
            <a href="#"><img src="{{ URL::asset('images/copylink.png') }}"></a>
        </div>
        <div class="vi-note">
            <div class="vi-card-corner">
                <div class="vi-card-corner-triangle"></div>
            </div>
            <p class="vi-note-title">Note 1</p>
            <div class="note-content">
                <p class="vi-text-light">A scelerisque purus semper eget duis. Dignissim cras tincidunt lobortis feugiat
                    vivamus at augue eget arcu.</p>
                <p class="vi-text-dark">Dignissim enim sit amet venenatis urna cursus eget nunc.</p>
            </div>
            <div class="vi-note-action">
                <a href="#" class="vi-icons note-delete"></a>
                <a href="#" class="vi-icons note-edit"></a>
            </div>
        </div>
        <div class="tag-wrap border-0">
            <div class="added-tags">
                <span>Article 72</span>
                <span>Article 72</span>
                <span>Article 72</span>
            </div>
        </div>
    </div>
</div>


<script>
    getNotes();

    async function getNotes() {
        const response = await fetch("{{ route('notes.all') }}");
        const notes = await response.json();
    }
</script>
