@php
    use App\Services\ArticleService;
@endphp
<div class="vi-highlights-sidebar">
    <div class="vi-announcement-wrap">
        <h5 class="vi-sidebar-title">What’s New</h5>
        <div class="vi-announcement-card">
            <p class="vi-announcement-title">Announcements</p>
            <ul>
                @foreach($announcements as $announcement)
                    <li>
                        <span class="limited-text text-xs">{!! $announcement->content !!}</span>
                        <div class="hidden-text">{!! $announcement->content !!}</div>
                    </li>
                @endforeach
            </ul>
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
