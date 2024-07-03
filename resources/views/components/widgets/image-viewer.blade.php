<div id="topic-at-glance" x-data x-init="$watch('isTopicAtGlanceOpen', value => createViewer())" class="mt-3 min-h-[500px] min-w-full">
    <img style="display: none" id="image" src="{{ $image?->media?->first()?->getUrl() }}"  alt="{{ $image?->title }}"/>
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
                viewer.zoomTo(1);
                viewer.moveTo(
                    (document.getElementById('topic-at-glance').offsetWidth - document.getElementById('image').naturalWidth) / 2,
                    0
                );
                viewer.reset = () => {
                    viewer.zoomTo(1);
                    viewer.moveTo(
                        (document.getElementById('topic-at-glance').offsetWidth - document.getElementById('image').naturalWidth) / 2,
                        0
                    );
                }
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
