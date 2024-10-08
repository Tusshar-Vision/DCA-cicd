<div class="vi-modal-inner mt-[20px]">
    <div class="vi-modal-content">
        <div class="overflow-auto max-h-60 mb-2" id="notes-container">
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
    @if (Auth::check())
        getNotes();
    @endif

    async function getNotes() {
        const response = await fetch("{{ route('notes.of-article', ['article_id' => $articleId]) }}");
        const notes = await response.json();
        console.log("notes", notes);
        if (notes) {
            const notesGroupBy = Object.groupBy(notes, ({
                title
            }) => title);

            console.log("notesgroupby", notesGroupBy)

            let html = "";
            for (const title in notesGroupBy) {
                html += `<div class="vi-note-wrap mb-4">
                         <div class="vi-note">
                         <p class="vi-note-title" style="font-weight:bold">${title}</p>
                         <div class="note-content">`;
                for (let i = 0; i < notesGroupBy[title].length; i++) {
                    for (let j = 0; j < notesGroupBy[title][i].note_contents.length; j++) {
                        html +=
                            ` <p class="vi-text-light">${notesGroupBy[title][i].note_contents[j].content}</p>`
                    }
                }

                html += `</div>
                            <div class="vi-note-action">
                                <a href="#"><img src="{{ URL::asset('images/delete-note.png') }}"></a>
                                <a href="#"><img src="{{ URL::asset('images/edit-note.png') }}"></a>
                            </div>
                        </div>
                        <div class="copylink-row copy-link tag-gap">
                            <p type="text" class="copy-link-input">Current Affairs / blog-article1</p>
                            <button type="button" class="copy-link-button" onclick="copy()">
                                <span><img src="{{ URL::asset('images/copy-link.png') }}"></span>
                            </button>
                        </div>   
                        </div>`;
            }

            document.getElementById("notes-container").innerHTML = html;
        }
    }

    function copy() {
        const inputField = document.querySelector(".copy-link-input");
        const copyButton = document.querySelector(".copy-link-button");
        const text = inputField.innerText;
        navigator.clipboard.writeText("text", text);
        inputField.innerText = "Copied!";
        setTimeout(() => (inputField.innerText = text), 2000);
    }
</script>
