<div {{ $attributes }}>
    @foreach ($articles as $key => $article)
        <div x-data="{isSectionOpen{{ $key }}: true}" id="{{ $article->slug }}" class="border-2 border-visionSelectedGray rounded px-4 py-2 mb-6">

            <a href="#{{ $article->slug }}">
                <div
                    @click="isSectionOpen{{ $key }} = !isSectionOpen{{ $key }}"
                    class="cursor-pointer text-[#183B56] hover:text-[#3362CC] flex justify-between border-b-[1px] border-b-[#183B56] hover:border-b-[#3362CC] w-full pb-2 svgHover accorActive"
                >
                    <h2 class="text-2xl text-black font-semibold">{{$article->title}}</h2>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" :class="isSectionOpen{{ $key }} === true || 'rotate-180'" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <g clip-path="url(#clip0_3420_22861)">
                                <path d="M11.9544 10.9087L6.86307 16L5.40872 14.5456L11.9544 8L18.5 14.5456L17.0456 16L11.9544 10.9087Z" fill="#183B56"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_3420_22861">
                                    <rect width="24" height="24" fill="white" transform="matrix(-1 0 0 -1 24 24)"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>
            </a>

            <div x-show="isSectionOpen{{ $key }} === true" class="text-[#3D3D3D] flex flex-col mt-4 pb-2" x-collapse>

                <div class="dark:text-white ck-content" :style="`font-size: ${fontSize}rem`">{!! $article->content !!}</div>

            </div>
        </div>
    @endforeach

    @if (count($tags) > 0)
        <x-widgets.article-tags :tags="$tags" />
    @endif

    @if ((count($sources) > 0 && $sources[0] !== ''))
        <x-widgets.article-sources :sources="$sources" />
    @endif
</div>
