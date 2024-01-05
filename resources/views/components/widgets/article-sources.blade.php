<div x-data="{ expanded: false }" @click="expanded = ! expanded" :class="{ 'items-center': !expanded }"  class="border-2 border-visionSelectedGray rounded px-4 py-2 flex justify-between cursor-pointer" x-transition>
    <div class="space-y-5">
        <div>
            <h1 class="text-lg font-bold">Sources</h1>
            <p class="text-visionLineGray text-sm">{{ count($sources) }} sources</p>
        </div>
        <div class="text-visionLineGray text-sm font-light italic flex flex-col space-y-2" x-show="expanded" x-collapse>
            @foreach($sources as $url)
                <a class="hover:underline break-all" href="{{ $url }}" target="_blank">
                    {{ $url }}
                </a>
            @endforeach
        </div>
    </div>
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
