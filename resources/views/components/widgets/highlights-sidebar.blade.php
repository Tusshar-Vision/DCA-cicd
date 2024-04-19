@use ('App\Services\ArticleService')

<style>
    .announcement-container {
        overflow: hidden;
        max-width: 270px;
        min-width: 270px;
        max-height: 200px; /* Set a fixed height for the container */
        position: relative;
        transition: height 0.3s;
    }

    .announcement-container ul {
        list-style: none;
        padding: 0;
        margin: 0;
        animation: scrollList 20s linear infinite; /* Adjust the duration as needed */
    }

    .announcement-container li {
        display: block;
        margin-bottom: 20px; /* Adjust spacing between announcements */
    }

    @keyframes scrollList {
        0% {
            transform: translateY(70%);
        }
        100% {
            transform: translateY(-100%);
        }
    }

    .pause-scroll {
        animation-play-state: paused !important;
    }
</style>

<div x-data="{ isAnnouncementsModalOpen: false, isAnnouncementsSelected: true, isLatestNewsSelected: false }" class="vi-highlights-sidebar w-full lg:w-auto">
    <div class="vi-announcement-wrap w-full lg:w-auto">
        <h5 class="vi-sidebar-title">What’s New</h5>
        <div class="vi-announcement-card">
            <div class="flex justify-between items-center">
                <p class="vi-announcement-title">Announcements</p>
                <a @click="isAnnouncementsModalOpen = !isAnnouncementsModalOpen" class="vi-announcement-title cursor-pointer hover:underline text-xs">View All</a>
            </div>
            <div x-data="{ isHovered: false }" class="announcement-container">
                <ul
                    x-ref="announcementContainer"
                    @mouseenter="isHovered = true"
                    @mouseleave="isHovered = false"
                    x-bind:class="{ 'pause-scroll': isHovered }"
                >
                    @if($announcements->isNotEmpty())
                        @foreach($announcements as $announcement)
                            <li>
                                <span class="text-xs">{!! $announcement->content !!}</span>
                            </li>
                        @endforeach
                    @else
                        <li>
                            <span class="limited-text text-xs">No New Announcements</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="vi-announcement-card">
            <p class="vi-announcement-title">News Updates</p>
            <ul>
                @foreach($newsUpdates as $news)
                    <li>
                        <a href="{{ ArticleService::getArticleUrlFromSlug($news->slug) }}" wire:navigate>
                            <span class="limited-text text-xs">{{ $news->title }}</span>
                            <div class="hidden-text">{{ $news->title }}</div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <x-modals.modal-box x-show="isAnnouncementsModalOpen" heading="What's New">
        <ul class="flex justify-start align-middle my-4" x-transition>
            <li @click="isAnnouncementsSelected = true; isLatestNewsSelected = false" class="cursor-pointer border-b-2 border-b-transparent hover:border-gray-600 mr-4 pb-2" :class="isAnnouncementsSelected && 'activeTab'">Announcements</li>
            <li @click="isAnnouncementsSelected = false; isLatestNewsSelected = true" class="cursor-pointer border-b-2 border-b-transparent hover:border-gray-600 pb-1" :class="isLatestNewsSelected && 'activeTab'">News Updates</li>
        </ul>
        <ul x-show="isAnnouncementsSelected" class="text-left overflow-y-auto">
            @if($announcements->isNotEmpty())
                @foreach($announcements as $announcement)
                    <li class="p-2 mb-1 rounded-md border-l-2 border-transparent hover:border-[#5A7184] hover:underline hover:bg-[#B3BAC5] hover:bg-opacity-10">
                        <a href="javascript:void(0)">
                            <p class="text-sm hover:text-blue-800">{!! $announcement->content !!}</p>
                        </a>
                    </li>
                @endforeach
            @else
                <li class="p-2 mb-1 rounded-md border-l-2 border-transparent hover:border-[#5A7184] hover:underline hover:bg-[#B3BAC5] hover:bg-opacity-10">
                    <span class="limited-text text-xs">No New Announcements</span>
                </li>
            @endif
        </ul>
        <ul x-show="isLatestNewsSelected" class="text-left overflow-y-auto">
            @foreach($newsUpdates as $news)
                <li class="p-2 mb-1 rounded-md border-l-2 border-transparent hover:border-[#5A7184] hover:underline hover:bg-[#B3BAC5] hover:bg-opacity-10">
                    <a href="{{ ArticleService::getArticleUrlFromSlug($news->slug) }}" wire:navigate>
                        <p class="text-sm hover:text-blue-800 dark:hover:text-white">{{ $news->title }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </x-modals.modal-box>
</div>
<script>
    function truncateText(selector, maxLength = 35) {
        let elements = document.querySelectorAll(selector);
        for(let i= 0; i < elements.length; i++) {
            elements[i].innerText = elements[i].innerText.substr(0, maxLength) + '...';
        }
    }
    truncateText(".limited-text");
</script>
