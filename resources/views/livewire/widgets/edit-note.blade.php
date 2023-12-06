<div class="vi-modal-inner mt-[20px]">
    <div class="vi-modal-content" id="notes-container">
        <div class="overflow-auto max-h-60 mb-2">
            <!-- loop area -->
            <div class="vi-note-wrap mb-4">
                <div class="vi-note">
                    <p class="vi-note-title">Note 1</p>
                    <div class="note-content">
                        <p class="vi-text-light">A scelerisque purus semper eget duis. Dignissim cras tincidunt lobortis
                            feugiat vivamus at augue eget arcu.</p>
                    </div>
                    <div class="vi-note-action">
                        <a href="#"><img src="{{ URL::asset('images/delete-note.png') }}"></a>
                        <a href="#"><img src="{{ URL::asset('images/edit-note.png') }}"></a>
                    </div>
                </div>
                <div class="copylink-row tag-gap">
                    <p>Current Affairs / blog-note4</p>
                    <a href="#"><img src="{{ URL::asset('images/copylink.png') }}"></a>
                </div>
            </div>
            <div class="vi-note-wrap mb-4">
                <div class="vi-note">
                    <p class="vi-note-title">Note 2</p>
                    <div class="note-content">
                        <p class="vi-text-light">A scelerisque purus semper eget duis. Dignissim cras tincidunt lobortis
                            feugiat vivamus at augue eget arcu.</p>
                    </div>
                    <div class="vi-note-action">
                        <a href="#"><img src="{{ URL::asset('images/delete-note.png') }}"></a>
                        <a href="#"><img src="{{ URL::asset('images/edit-note.png') }}"></a>
                    </div>
                </div>
                <div class="copylink-row tag-gap">
                    <p>Current Affairs / blog-note4</p>
                    <a href="#"><img src="{{ URL::asset('images/copylink.png') }}"></a>
                </div>
            </div>
            <!-- loop area -->
        </div>
        <div class="tag-wrap">
            <div class="added-tags list-tags">
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
        console.log("notrs", notes)

        let html = ""
        for (let i = 0; i < notes.length; i++) {
            html += `<div class="vi-note-wrap mb-4">
                <div class="vi-note">
                    <p class="vi-note-title">${notes[i].title}</p>
                    <div class="note-content">
                        <p class="vi-text-light">${notes[i].content}</p>
                    </div>
                    <div class="vi-note-action">
                        <a href="#"><img src="{{ URL::asset('images/delete-note.png') }}"></a>
                        <a href="#"><img src="{{ URL::asset('images/edit-note.png') }}"></a>
                    </div>
                </div>
                <div class="copylink-row tag-gap">
                    <p>Current Affairs / blog-note4</p>
                    <a href="#"><img src="{{ URL::asset('images/copylink.png') }}"></a>
                </div>
            </div>`
        }

        document.getElementById("notes-container").innerHTML = html;
    }
</script>
