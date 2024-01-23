@php
    use App\Services\ArticleService;
    use Carbon\Carbon;

    $width = '';
    $height = '';

    switch($type) {
        case 'medium':
            $width = '459px';
            $height = '285px';
            break;
        case 'large':
            $width = '700px';
            $height = '285px';
            break;
        default:
            $width = '292px';
            $height = '186px';
            break;
    }

    $articleUrl = ArticleService::getArticleURL($article);
    $featuredImage = $article->getFirstMediaUrl('article-featured-image');
@endphp

<div class="group cursor-pointer flex-col max-w-2xl">
    <a href="{{ $articleUrl }}" class="space-y-2">
        <div class="space-y-2">
            <div class="overflow-hidden coverImage">
                <img
                    src="{{ ($featuredImage === '') ? 'https://placehold.co/1596x930' : $featuredImage }}"
                    width="{{ $width }}" height="{{ $height }}" alt="" class="group-hover:scale-105 transition-all"/>
            </div>
            <div class="text-visionLineGray flex items-center space-x-3 text-sm">
                <p><strong>Updated</strong> {{ Carbon::parse($article->updated_at)->format('d M Y')  }}</p>
            </div>
            <div>
                <h2 class="text-xl font-bold">{{ $article->title }}</h2>
            </div>
            <div class="max-w-prose">
                <p class="text-visionLineGray line-clamp-3 text-sm">{{ $article->excerpt }}</p>
                <a href="{{ $articleUrl }}" class="group-hover:underline text-visionBlue text-sm">Read More</a>
            </div>
        </div>
    </a>
</div>
