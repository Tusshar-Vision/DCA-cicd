<div x-data="{ expanded: false }" :class="{ 'items-center': !expanded }" class="border-2 border-visionSelectedGray rounded mt-[20px] px-4 py-2">
    <div @click="expanded = ! expanded" class="cursor-pointer text-[#3D3D3D] hover:text-[#3362CC] flex justify-between border-b-[1px] hover:border-b-[#3362CC] w-full pb-2 svgHover">
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
    <div x-show="expanded" class="text-[#3D3D3D] text-sm font-light flex flex-col mt-4 pb-2" x-collapse>
        @foreach ($sources as $source)
            <a class="hover:underline break-all" href="{{$source}}" target="_blank">{{ substr($source, 0, 100) }}</a>
        @endforeach
    </div>
</div>
