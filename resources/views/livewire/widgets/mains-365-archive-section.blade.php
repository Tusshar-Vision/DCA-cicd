<div class="w-full">
<div class="pt-[25px] border-t-2">
    <div class="flex w-full items-center justify-end space-x-4 mb-[25px]">
        <p>Filter</p>
        <livewire:widgets.filter />
    </div>
</div>

<!-- Mains 365 -->

@foreach ($data as $year => $files)
    <div class="archiveWrapper mb-[15px] border-b-2 mt-[20px]">
    <div class="flex justify-between items-center archiveHeader cursor-pointer mb-[20px]">
        <h4 class="text-[#040404] text-[32px] font-normal">Mains 365 - {{$year}}</h4>
        <div>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
            </svg>
            <svg class="hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
            </svg>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 archiveContent pb-[30px]">
        @foreach ($files as $file)
            <div class="weekly-focus-single-card">
            <div class="weekly-focus-progress-list mt-0">
                <div class="weekly-focus-progress-single-bar border-b-2">
                    <p>{{ucfirst($file['name'])}}</p>
                    <ul class="flex justify-start space-x-4 mt-[15px]">
                        <li class="text-[#3362CC] text-sm font-normal"><a href="{{ route('view-file', ['media' => $file]) }}" class="hover:underline" target="_blank">Read</a></li>
                        <li class="text-[#3362CC] text-sm font-normal"><a href="{{ route('download', ['media' => $file]) }}" class="hover:underline">Download</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach

<div class="archiveWrapper mb-[15px] border-b-2">
    <div class="flex justify-between items-center archiveHeader cursor-pointer mb-[20px]">
        <h4 class="text-[#040404] text-[32px] font-normal">2022</h4>
        <div>
            <svg class="hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
            </svg>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
            </svg>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 archiveContent pb-[30px] hidden">
        <div class="weekly-focus-single-card">
            <div class="weekly-focus-progress-list mt-0">
                <div class="weekly-focus-progress-single-bar border-b-2">
                    <p>Science and Technology Aug22-May23</p>
                    <ul class="flex justify-start space-x-4 mt-[15px]">
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Read</a></li>
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Download</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="weekly-focus-single-card">
            <div class="weekly-focus-progress-list mt-0">
                <div class="weekly-focus-progress-single-bar border-b-2">
                    <p>Environment Aug22-May23</p>
                    <ul class="flex justify-start space-x-4 mt-[15px]">
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Read</a></li>
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Download</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="weekly-focus-single-card">
            <div class="weekly-focus-progress-list mt-0">
                <div class="weekly-focus-progress-single-bar border-b-2">
                    <p>Social Issues Aug22-May23</p>
                    <ul class="flex justify-start space-x-4 mt-[15px]">
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Read</a></li>
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Download</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="weekly-focus-single-card">
            <div class="weekly-focus-progress-list mt-0">
                <div class="weekly-focus-progress-single-bar border-b-2">
                    <p>Social Issues Aug22-May23</p>
                    <ul class="flex justify-start space-x-4 mt-[15px]">
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Read</a></li>
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Download</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="weekly-focus-single-card">
            <div class="weekly-focus-progress-list mt-0">
                <div class="weekly-focus-progress-single-bar border-b-2">
                    <p>Updated Part 1</p>
                    <ul class="flex justify-start space-x-4 mt-[15px]">
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Read</a></li>
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Download</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="weekly-focus-single-card">
            <div class="weekly-focus-progress-list mt-0">
                <div class="weekly-focus-progress-single-bar border-b-2">
                    <p>Social Issues</p>
                    <ul class="flex justify-start space-x-4 mt-[15px]">
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Read</a></li>
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Download</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
