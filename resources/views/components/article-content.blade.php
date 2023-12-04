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

<div class="text-tooltip-comp" id="tooltip-box">
    <button>Copy</button>
    <button onclick="highlightText()" id="btn">Highlight</button>
    <button onclick="showModal()">Add Note</button>
</div>

<div id="add-note-modal" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    style="display:none">
    <!--
      Background backdrop, show/hide based on modal state.
  
      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Deactivate
                                account</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Add Note.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button"
                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Add
                        Note</button>
                    <button type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                        onclick="hideModal()">Cancel</button>
                </div>
            </div>
        </div>
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
