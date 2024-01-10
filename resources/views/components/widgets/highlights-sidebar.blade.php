@use ('App\Services\ArticleService')

<style>
    .announcement-container {
        overflow: hidden;
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

<div class="vi-highlights-sidebar w-full lg:w-auto">
    <div class="vi-announcement-wrap w-full lg:w-auto">
        <h5 class="vi-sidebar-title">What’s New</h5>
        <div class="vi-announcement-card">
            <div class="flex justify-between items-center">
                <p class="vi-announcement-title">Announcements</p>
                <a class="vi-announcement-title cursor-pointer hover:underline text-xs">View All</a>
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
                        <a href="{{ ArticleService::getArticleUrlFromSlug($news->slug) }}">
                            <span class="limited-text text-xs">{{ $news->title }}</span>
                            <div class="hidden-text">{{ $news->title }}</div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<script>
    function truncateText(selector, maxLength = 35) {
        let elements = document.querySelectorAll(selector);
        for(let i= 0; i < elements.length; i++) {
            elements[i].innerText = elements[i].innerText.substr(0, maxLength) + '...';
        }
        return truncated;
    }

    truncateText(".limited-text");
</script>
