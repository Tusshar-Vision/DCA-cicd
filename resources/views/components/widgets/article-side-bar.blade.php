@php
    $currentArticle = request()->segment(4);
@endphp
<div class="flex flex-col rounded bg-visionGray pb-4">
    <div class="my-4 mx-6">
        <h4 class="font-bold text-base[16px] py-[16px] border-bottom">Table of Content</h4>
        <div>
            <ol class="ml-[24px] list-decimal">
                @foreach($tableOfContent as $key => $header)
                    <li class="py-[15px] border-bottom hover:brand-color">
                        @if(is_array($header))
                            <a href="#header-{{$header['id']}}" class="block text-base[16px] font-medium black-040404 hover:brand-color">
                                {{ strip_tags($header['header']) }}
                            </a>
                        @else
                            <a href="{{ \App\Services\ArticleService::getArticleUrlFromSlug($header->slug) }}"
                               class="block text-base[16px] font-medium hover:brand-color {{ ($header->slug === $currentArticle) ? 'brand-color' : '' }}">
                                {{ $header->title }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
