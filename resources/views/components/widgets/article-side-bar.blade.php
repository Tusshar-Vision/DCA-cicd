@php
    use App\Services\ArticleService;
    $currentArticle = request()->segment(4);
@endphp
<div class="flex flex-col rounded bg-visionGray pb-4 lg:mt-10 mt-0">
    <div class="my-4 mx-6">
        <h4 class="font-bold text-base[16px] py-[16px] border-bottom">Table of Content</h4>
        <div>
            <ul class="list-none ml-0">
                @foreach($tableOfContent as $key => $header)
                        @if(is_array($header))
                            @if (isset($header['id']))
                                <li class="py-[15px] border-bottom last:border-0 hover:brand-color">
                                    <a href="#header-{{ $header['id'] }}"
                                       class="flex text-base[16px] font-normal black-040404 hover:brand-color">
                                        <span class="mr-1">{{ $loop->iteration }}<em>.</em></span>{{ strip_tags($header['header']) }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="py-[15px] border-bottom last:border-0 hover:brand-color">
                                <a href="{{ ArticleService::getArticleUrlFromSlug($header->slug) }}"
                                   wire:navigate
                                   class="flex text-base[16px] font-normal hover:brand-color {{ ($header->slug === $currentArticle) ? 'brand-color' : '' }}"
                                >
                                    <span class="mr-1">{{ $loop->iteration }}<em>.</em></span> {{ $header->title }}
                                </a>
                            </li>
                        @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
