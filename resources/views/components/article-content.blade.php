<style>
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
        border-left: 1px solid #8F93A3;
        padding: 0 6px;
        line-height: 20px;
        cursor: pointer;
    }

    .text-tooltip-comp button:hover {
        color: #CCE3CC;
    }

    .text-tooltip-comp button:first-child {
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

<div class="w-full">
    <div class="text-tooltip-comp" id="tooltip-box">
        <button>Copy</button>
        <button onclick="highlightText()" id="btn"
            @click="{{ !Auth::guard('cognito')->check() ? 'isLoginFormOpen = true' : '' }}">Highlight</button>
        <button @click="{{ Auth::guard('cognito')->check() ? 'isNoteOpen = true' : 'isLoginFormOpen=true' }}"
            onclick="hidePopup()">Add
            Note</button>
    </div>

    <div id="article-content" class="mt-4 printable-area ck-content">
        {!! $article->content !!}
    </div>

    <ul class="flex justify-start items-baseline mt-4">
        <li class="text-[#3D3D3D] text-base mr-2 dark:text-white">Tags :</li>
        @foreach ($article->tags as $tag)
            <li class="mr-2 bg-[#F4F6F8] text-xs rounded-sm py-1 px-2 cursor-pointer dark:text-white dark:bg-dark545557">{{ $tag->name }}</li>
        @endforeach
    </ul>

    @if ((count($article->sources) > 0 && $article->sources[0] !== ''))
        <x-widgets.article-sources :sources="$article->sources" />
    @endif
</div>

{{--<script>--}}

{{--    tinymce.init({--}}
{{--        selector: 'textarea#notes-text-area',--}}
{{--        plugins: 'code table lists',--}}
{{--        menubar: false,--}}
{{--        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',--}}
{{--    });--}}
{{--    @if (Auth::guard('cognito')->check())--}}
{{--        window.onload = addReadArticle--}}

{{--        function addReadArticle() {--}}
{{--            console.log("add read article", "{{ Auth::guard('cognito')->user()->name }}");--}}
{{--            const article_id = "{{ $article->getID() }}";--}}
{{--            const article_published_at = "{{$article->publishedAt}}"--}}
{{--            const student_id = "{{ Auth::guard('cognito')->user()->id }}"--}}
{{--            saveData("{{ route('user.read-history') }}", {--}}
{{--                article_id,--}}
{{--                student_id,--}}
{{--                article_published_at,--}}
{{--                read_percent: 0,--}}
{{--                _token: "{{ csrf_token() }}"--}}
{{--            })--}}
{{--        }--}}
{{--    @endif--}}

{{--    const doc = document.getElementById("article-content");--}}
{{--    // doc.addEventListener('mouseup', handleSelection);--}}
{{--    var pageX, pageY;--}}

{{--    function getSelectionText() {--}}
{{--        var selectedText = ""--}}
{{--        if (window.getSelection) { // all modern browsers and IE9+--}}
{{--            selectedText = window.getSelection().toString()--}}
{{--        }--}}
{{--        return selectedText--}}
{{--    }--}}

{{--    function hidePopup() {--}}

{{--        let editorContent = tinymce.get('notes-text-area').getContent()--}}
{{--        var selectedHTML = getSelectedHTML();--}}

{{--        if (selectedHTML.trim() !== "") {--}}
{{--            var tempTextarea = document.createElement("textarea");--}}
{{--            tempTextarea.style.position = "absolute";--}}
{{--            tempTextarea.style.left = "-9999px";--}}
{{--            tempTextarea.value = selectedHTML;--}}
{{--            document.body.appendChild(tempTextarea);--}}
{{--            tempTextarea.select();--}}

{{--            try {--}}
{{--                // Use document.execCommand to copy to the clipboard--}}
{{--                document.execCommand('copy');--}}
{{--                // console.log('HTML content has been copied to the clipboard:', selectedHTML);--}}
{{--                editorContent += selectedHTML;--}}
{{--                tinymce.activeEditor.setContent(editorContent)--}}
{{--            } catch (error) {--}}
{{--                console.error('Unable to copy HTML content to the clipboard:', error);--}}
{{--            } finally {--}}
{{--                document.body.removeChild(tempTextarea);--}}
{{--            }--}}
{{--        } else {--}}
{{--            console.warn("Nothing selected to copy.");--}}
{{--        }--}}

{{--        document.getElementById("tooltip-box").style.display = "none"--}}
{{--    }--}}

{{--    function getSelectedHTML() {--}}
{{--        var selectedHTML = "";--}}
{{--        var selection = window.getSelection();--}}

{{--        if (selection.rangeCount > 0) {--}}
{{--            var range = selection.getRangeAt(0);--}}
{{--            var clonedSelection = range.cloneContents();--}}
{{--            var div = document.createElement('div');--}}
{{--            div.appendChild(clonedSelection);--}}
{{--            selectedHTML = div.innerHTML;--}}
{{--        }--}}

{{--        return selectedHTML;--}}
{{--    }--}}

{{--    function showModal() {--}}
{{--        document.getElementById("add-note-modal").style.display = "block"--}}
{{--    }--}}

{{--    function hideModal() {--}}
{{--        document.getElementById("add-note-modal").style.display = "none"--}}
{{--    }--}}

{{--    document.addEventListener("mousedown", (e) => {--}}
{{--        pageX = e.pageX;--}}
{{--        pageY = e.pageY;--}}
{{--    });--}}

{{--    function handleSelection() {--}}
{{--        // If there is already a share dialog, remove it--}}
{{--        if (doc.contains(document.getElementById("tooltip-box"))) document.getElementById("tooltip-box").remove();--}}

{{--        let selection = document.getSelection();--}}
{{--        let selectedText = selection.toString();--}}
{{--        var menu = document.querySelector(".text-tooltip-comp");--}}
{{--        if (selectedText !== "") {--}}
{{--            let rect = document.querySelector("#article-content").getBoundingClientRect();--}}
{{--            menu.style.display = "block";--}}
{{--            menu.style.left = pageX - 90 + "px"--}}
{{--            menu.style.top = pageY - 64 + "px";--}}
{{--            menu.style.display = "block"--}}
{{--        } else {--}}
{{--            menu.style.display = "none";--}}
{{--        }--}}

{{--    }--}}

{{--    function highlightText() {--}}
{{--        @if (Auth::guard('cognito')->check())--}}
{{--            highlightSelectedText('highlight');--}}
{{--            document.getElementById("tooltip-box").style.display = "none"--}}
{{--        @endif--}}
{{--    }--}}

{{--    function addHighlight({--}}
{{--        highlight,--}}
{{--        serializedData--}}
{{--    }) {--}}
{{--        @if (Auth::check())--}}
{{--            saveData("{{ route('highlights.add') }}", {--}}
{{--                highlight,--}}
{{--                serializedData,--}}
{{--                user_id: "{{ Auth::check() ? Auth::user()->id : '' }}",--}}
{{--                article_id: {{ $article->getID() }},--}}
{{--                _token: '{{ csrf_token() }}'--}}
{{--            });--}}
{{--        @else--}}
{{--            if (localStorage.getItem('highlights')) {--}}
{{--                let highlights = JSON.parse(localStorage.getItem('highlights'));--}}
{{--                highlights.push({--}}
{{--                    highligh,--}}
{{--                    serializedData,--}}
{{--                })--}}
{{--            }--}}
{{--        @endif--}}
{{--    }--}}

{{--    async function postHighlight(data) {--}}
{{--        try {--}}
{{--            const response = await fetch("{{ route('highlights.add') }}", {--}}
{{--                method: "POST",--}}
{{--                headers: {--}}
{{--                    "Content-Type": "application/json",--}}
{{--                },--}}
{{--                body: JSON.stringify(data),--}}
{{--            });--}}

{{--            const result = await response.json();--}}
{{--        } catch (error) {--}}
{{--            console.error("Error:", error);--}}
{{--        }--}}
{{--    }--}}

{{--    async function loadHighlights() {--}}
{{--        const serrializedData = await getData(--}}
{{--            "{{ route('highlights.serialized', ['article_id' => $article->getID()]) }}", 'text');--}}
{{--        const serial = serrializedData.data?.serialized;--}}
{{--        if (serial) showHighlights(serial);--}}
{{--    }--}}

{{--    @if (Auth::guard('cognito')->check())--}}
{{--        {--}}
{{--            setTimeout(() => {--}}
{{--                loadHighlights()--}}
{{--            }, 4000);--}}
{{--        }--}}
{{--    @endif--}}
{{--</script>--}}
