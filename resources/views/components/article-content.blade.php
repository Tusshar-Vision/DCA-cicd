<style type="text/css">
    .highlight {
        background-color: yellow;
    }

    .note {
        background-color: limegreen;
    }

    #summary {
        border: dotted orange 1px;
    }

    /* tooltip comp */
    .text-tooltip-comp,
    .img-tooltip-comp {
        position: absolute;
        margin: 0;
        background-color: rgba(4, 4, 4, 0.6);
        padding: 12px 6px;
        border-radius: 5px;
        display: none
    }

    .img-tooltip-comp {
        max-width: 320px;
    }

    .text-tooltip-comp::after,
    .img-tooltip-comp::after {
        content: "";
        left: 50%;
        margin-left: -5px;
        position: absolute;
        bottom: -5px;
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid rgba(4, 4, 4, 0.6);
    }

    .text-tooltip-comp button {
        display: inline-block;
        font-size: 14px;
        color: #fff;
        border-right: 1px solid #8F93A3;
        padding: 0 6px;
        line-height: 20px;
        cursor: pointer;
    }

    .text-tooltip-comp button:hover {
        color: #CCE3CC;
    }

    .text-tooltip-comp button:last-child {
        border: 0;
    }

    .img-tooltip-comp img {
        width: 100%;
    }

    .img-tooltip-comp h6,
    .img-tooltip-comp p {
        color: #FFF;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        border-bottom: 1px solid #fff;
        padding: 0 0 0px;
        margin: 0 0 5px;
    }

    .img-tooltip-comp p {
        border: 0;
    }

    /***/
</style>

<div class="text-tooltip-comp" id="tooltip-box" x-data="{ isNoteOpen: false }">
    <button>Copy</button>
    <button onclick="highlightText()" id="btn">Highlight</button>
    <button @click="isNoteOpen=true">Add Note</button>
    <div>
        <x-modals.modal-box x-show="isNoteOpen" heading="Add Note">
            <livewire:widgets.add-note />
        </x-modals.modal-box>
    </div>
</div>

<button onclick="noteSelectedText()">
    Add Note
</button>

<div id="article-content" onmouseup="handleSelection()" class="mt-4 printable-area">
    {!! $article->content !!}
</div>

<script>
    const doc = document.getElementById("article-content");
    doc.addEventListener('mouseup', handleSelection);
    var pageX, pageY;

    function showModal() {
        document.getElementById("add-note-modal").style.display = "block"
    }

    function hideModal() {
        document.getElementById("add-note-modal").style.display = "none"
    }

    document.addEventListener("mousedown", (e) => {
        pageX = e.pageX;
        pageY = e.pageY;
    });

    function handleSelection() {
        // If there is already a share dialog, remove it
        if (doc.contains(document.getElementById("tooltip-box"))) document.getElementById("tooltip-box").remove();

        let selection = document.getSelection();
        let selectedText = selection.toString();
        var menu = document.querySelector(".text-tooltip-comp");
        if (selectedText !== "") {
            let rect = document.querySelector("#article-content").getBoundingClientRect();
            menu.style.display = "block";
            menu.style.left = pageX - 90 + "px"
            menu.style.top = pageY - 64 + "px";
            menu.style.display = "block"
        } else {
            menu.style.display = "none";
        }

    }

    function highlightText() {
        highlightSelectedText('highlight');
        document.getElementById("tooltip-box").style.display = "none"
    }
</script>
