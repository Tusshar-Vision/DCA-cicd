<div x-data="{ openItem: 0, expanded: false }">
    @foreach ($articles as $key => $article)

        <div class="border-2 border-visionSelectedGray rounded px-4 py-2 mb-6">

            <div @click="openItem = (openItem == {{$key}} ? '-1' : {{$key}})" class="cursor-pointer text-[#183B56] hover:text-[#3362CC] flex justify-between border-b-[1px] border-b-[#183B56] hover:border-b-[#3362CC] w-full pb-2 svgHover accorActive">
                <h1 class="text-lg">{{$article->title}}</h1>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" :class="openItem === {{ $key }} || 'rotate-180'" width="24" height="24" viewBox="0 0 24 24" fill="none">
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

            <div x-show="openItem == {{$key}}" class="text-[#3D3D3D] text-sm font-light flex flex-col mt-4 pb-2" x-collapse>

                <p>{!! $article->content !!}</p>

                <ul class="flex justify-start items-baseline mt-4">
                    <li class="text-[#3D3D3D] text-base mr-2">Tags :</li>
                    @foreach ($article->tags as $tag)
                        <li class="mr-2 bg-[#F4F6F8] text-xs rounded-sm py-1 px-2 cursor-pointer">{{ $tag->name }}</li>
                    @endforeach
                </ul>

                <!-- inner accordion start -->
                <div x-data="{ expanded: false }" @click="expanded = ! expanded" :class="{ 'items-center': !expanded }" class="border-2 border-visionSelectedGray rounded mt-[20px] px-4 py-2">
                    <div class="cursor-pointer text-[#3D3D3D] hover:text-[#3362CC] flex justify-between border-b-[1px] hover:border-b-[#3362CC] w-full pb-2 svgHover">
                        <h1 class="text-lg">Articles Sources</h1>
                        <div>
                            <div x-show="expanded === true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
                                </svg>
                            </div>
                            <div x-show="expanded === false">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div x-show="expanded" x-collapse class="text-[#3D3D3D] text-sm font-light flex flex-col mt-4 pb-2">
                          @foreach ($article->sources as $source)
                                <a href="{{$source}}">{{ substr($source, 0, 100) }}</a>
                          @endforeach
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</div>
