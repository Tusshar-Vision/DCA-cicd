<style>
    .note-container {
        padding: :24px;
        background-color: lightgray;
        margin: 12px;
        border-radius: 8px;
    }
</style>


<div id="notes-container">
    {{--  --}}
</div>

<script>
    let notes = localStorage.getItem("notes");
    if (notes != null) {
        notes = JSON.parse(notes);
        let html = "";
        for (let i = 0; i < notes.length; i++) {
            let notesHtml = "";
            for (let j = 0; j < notes[i].notes.length; j++) {
                notesHtml += `<p>${notes[i].notes[j]}</p>`
            }
            html += "<div class='note-container'>"
            html += `<div style="background-color: yellow">${notes[i].highlight_text}</div>
                    <div>`;
            html += notesHtml
            html += "</div></div>";
        }

        document.getElementById("notes-container").innerHTML = html;
    }
</script>
