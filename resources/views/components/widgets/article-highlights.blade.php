    <style>
        .vi-note.highlights .vi-note-title-wrap {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            border-bottom: 1px solid #E9E9E9;
            padding: 9px 12px;
        }

        .vi-note.highlights .vi-note-title-wrap .vi-note-title {
            border-bottom: 0;
            padding: 0;
        }

        .vi-note.highlights .vi-note-title-wrap {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            border-bottom: 1px solid #E9E9E9;
            padding: 9px 12px;
        }

        .vi-icons.note-delete:before {
            width: 20px;
            height: 20px;
            background-position: -186px -90px;
        }

        .vi-icons {
            transition: all 0.2s ease-in-out;
        }

        .vi-icons::before {
            content: '';
            background-image: "{{ URL::asset('images/main-sprite.svg') }}";
            background-repeat: no-repeat;
            display: inline-block;
            vertical-align: middle;
            width: 24px;
            height: 24px;
            transition: all 0.2s ease-in-out;
        }

        .vi-note.highlights .vi-note-title-wrap .vi-note-title {
            border-bottom: 0;
            padding: 0;
        }

        .vi-note .note-content {
            border-bottom: 1px solid #E9E9E9;
            padding: 9px 12px;
        }

        .vi-note .note-content p {
            font-size: 14px;
            display: inline;
        }

        .vi-note .note-content p:not(:first-child) {
            margin-top: 10px;
        }

        .vi-note .note-content .vi-text-dark {
            opacity: 1 !important;
        }

        .vi-note .note-content .vi-text-light {
            opacity: 0.5 !important;
        }

        .vi-note .note-content .vi-yellow-text {
            background-color: #FFF0BA;
        }

        .vi-note .note-content .vi-text-dark {
            opacity: 1 !important;
        }

        .vi-modal-wrap .vi-modal-inner .vi-modal-content {
            margin-top: 20px;
        }

        .vi-modal-wrap .vi-modal-inner .vi-modal-content p {
            font-size: 14px;
            font-weight: 400;
            color: #000000;
            line-height: 19px;
            margin-top: 0;
            opacity: 0.5;
        }

        .vi-modal-wrap .vi-modal-inner .vi-modal-content .vi-tinymce-editor {
            margin-top: 10px;
        }

        .vi-modal-wrap .vi-modal-inner .vi-modal-content .vi-modal-action {
            margin-top: 10px;
            text-align: right;
        }

        .vi-modal-wrap .vi-modal-inner .vi-modal-content .vi-modal-action a {
            display: inline-block;
            width: auto;
        }

        .vi-modal-wrap .vi-modal-inner .vi-modal-content .vi-modal-action a.vi-secondary-button {
            margin-right: 12px;
        }

        .vi-modal-wrap .vi-modal-inner .vi-modal-header {
            padding-bottom: 10px;
        }

        .vi-modal-wrap .vi-modal-inner .vi-modal-content {
            margin-top: 10px;
        }
    </style>

    <div id="highlights-container" class="vi-modal-content">

    </div>


    <script>
        let highlights = localStorage.getItem('highlights');
        if (highlights != null) {
            highlights = JSON.parse(highlights);
            let html = "";
            for (let i = 0; i < highlights.length; i++) {
                html += `<div class="vi-note highlights">
            <div class="vi-note-title-wrap">
                <p class="vi-note-title">Highlight ${i+1}</p>
                <a href="#" class="vi-icons note-delete"></a>
            </div>
            <div class="note-content">
                <p class="vi-text-dark">${highlights[i]}</p>
            </div>
        </div>`
            }

            document.getElementById('highlights-container').innerHTML = html;
        }
    </script>
