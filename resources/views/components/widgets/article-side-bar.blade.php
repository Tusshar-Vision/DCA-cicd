@php
    use App\Services\ArticleService;
    $currentArticle = request()->segment(4);
@endphp
<div class="flex flex-col rounded bg-visionGray pb-4">
    <div class="my-4 mx-6">
        <h4 class="font-bold text-base[16px] py-[16px] border-bottom">Table of Content</h4>
        <div>
            <ul class="list-none ml-0">
                @foreach($tableOfContent as $key => $header)
                    <li class="py-[15px] border-bottom last:border-0 hover:brand-color">
                        @if(is_array($header))
                            <a href="#header-{{$header['id']}}"
                               class="flex text-base[16px] font-normal black-040404 hover:brand-color">
                                <span class="mr-1">{{ $loop->iteration }}<em>.</em></span>{{ strip_tags($header['header']) }}
                            </a>
                        @else
                            <a href="{{ ArticleService::getArticleUrlFromSlug($header->slug) }}"
                               class="flex text-base[16px] font-normal hover:brand-color {{ ($header->slug === $currentArticle) ? 'brand-color' : '' }}">
                                <span class="mr-1">{{ $loop->iteration }}<em>.</em></span> {{ $header->title }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
