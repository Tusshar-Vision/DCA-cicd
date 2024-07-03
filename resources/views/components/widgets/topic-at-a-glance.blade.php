<div {{ $attributes }} class="flex flex-col rounded dark:bg-dark373839 border-top {{ $infographic === null ? 'opacity-50 pointer-events-none' : '' }}" @click="isTopicAtGlanceOpen = !isTopicAtGlanceOpen">
    <div class="my-4 mx-6">
        <a href="javascript:void(0)">
            <div class="flex items-center justify-between">
                <div class="flex space-x-2">
                    <div>
                        {!! \App\Helpers\SvgIconsHelper::getSvgIcon('topic-at-glance-icon') !!}
                    </div>
                    <span>
                        Topic at a Glance
                    </span>
                </div>
            </div>
        </a>
    </div>
</div>
