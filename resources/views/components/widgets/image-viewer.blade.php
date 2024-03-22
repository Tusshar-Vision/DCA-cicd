<div x-data x-init="$watch('isTopicAtGlanceOpen', value => createViewer())" class="mt-3" x-init="$watch('isTopicAtGlanceOpen', value => console.log(value))">
    <img id="image" src="{{ $image?->media?->first()?->getTemporaryUrl(now()->add('minutes', 120)) }}"  alt="{{ $image?->title }}"/>
</div>

<script>
    function createViewer() {
        var viewer = new Viewer(document.getElementById('image'), {
            inline: true,
            loading: true,
            navbar: false,
            toolbar: {
                oneToOne: true,
                reset: true,
                zoomIn: true,
                zoomOut: true,
                rotateLeft: true,
                rotateRight: true
            },
            viewed() {
                viewer.full();
            },
        });
    }
</script>
