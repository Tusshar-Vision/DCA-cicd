    <style>
        
    </style>

<div id="highlights-container" class="vi-modal-content">

</div>

<!-- <div class="vi-note-title-wrap">
        <p class="vi-note-title">Highlight ${i+1}</p>
        <a href="#" class="vi-icon"><img src="{{ URL::asset('images/delete-article.png') }}"></a>
    </div> -->

<script>
    getHighlights();

    async function getHighlights() {
        let highlights = await getData("{{ route('highlights') }}");
        highlights = highlights.data
        if (highlights) {
            let html = "";
            for (let i = 0; i < highlights.length; i++) {
                html += `<div class="vi-note highlights">
                            <div class="note-content">
                                <p class="vi-text-dark">${highlights[i].highlight}</p>
                            </div>
                        </div>`
            }

            document.getElementById('highlights-container').innerHTML = html;
        }
    }
</script>
