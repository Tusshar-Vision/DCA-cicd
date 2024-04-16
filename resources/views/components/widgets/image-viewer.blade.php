<div id="topic-at-glance" x-data x-init="$watch('isTopicAtGlanceOpen', value => createViewer())" class="mt-3 min-h-[500px] min-w-full">
    <img style="display: none" id="image" src="{{ $image?->media?->first()?->getTemporaryUrl(now()->add('minutes', 120)) }}"  alt="{{ $image?->title }}"/>
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
                rotateRight: true,
                fullscreen: false,
            },
            viewed() {
                viewer.moveTo(viewer.innerWidth / 2)
            },
        });
    }
</script>

<style>
    .viewer-container {
        width: 100% !important;
    }
    .viewer-fullscreen {
        display: none !important;
    }
</style>
