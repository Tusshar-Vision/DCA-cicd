<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,400&family=Tiro+Devanagari+Hindi&display=swap');

    div {
        font-family: Poppins, serif;
    }

    blockquote,
    dl,
    dd,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    hr,
    figure,
    p,
    pre {
        margin: 0;
    }

    fieldset {
        margin: 0;
        padding: 0;
    }

    legend {
        padding: 0;
    }

    ol,
    ul,
    menu {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    /*
    Reset default styling for dialogs.
    */
    dialog {
        padding: 0;
    }

</style>
@vite('resources/css/ck-content.css')
<div class="mt-4 w-full ck-content">
    {!! $article->content->content !!}
</div>
