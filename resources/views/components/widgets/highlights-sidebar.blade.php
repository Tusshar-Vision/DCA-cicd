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
                    <li>{!! $announcement->content !!}</li>
                @endforeach
            </ul>
        </div>
        <div class="vi-announcement-card">
            <p class="vi-announcement-title">News Updates</p>
            <ul>
                @foreach($newsUpdates as $news)
                    <li>
                        <a href="{{ ArticleService::getArticleUrlFromSlug($news->slug) }}">{{ $news->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
