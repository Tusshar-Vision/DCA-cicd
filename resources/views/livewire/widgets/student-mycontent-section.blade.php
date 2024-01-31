<div class="vigrid-wide">
    <div class="vi-profile-tab-container">
     <div class="my-content-tab-wrapper rounded">
        <!-- most recent tab newly added -->
        <div class="flex justify-between mb-6">
            <ul class="flex justify-start mb-[30px] xl:mb-0 text-[16px] text-[#8F93A3]">
                <li><a href="javascript:void(0)" class="hover:text-[#3362CC] activeSubTab">Paper</a></li>
                <li><a href="javascript:void(0)" class="ml-5 hover:text-[#3362CC]">Most Recent Notes</a></li>
            </ul>
            <div class="vi-dropdown">
                <div class="vi-dropbtn">Time<span class="vi-icons vi-drop-arrow"></span></div>
                <div class="vi-dropdown-content">
                    <a href="javascript:void(0)">This Year</a>
                    <a href="javascript:void(0)">Last 7 days</a>
                    <a href="javascript:void(0)">Last 15 days</a>
                    <a href="javascript:void(0)">This Month</a>
                    <a href="javascript:void(0)">Last Month</a>
                    <a href="javascript:void(0)">Custom</a>
                    <a href="javascript:void(0)">Clear Filter</a>
                </div>
            </div>
        </div>
        <!-- most recent tab newly added -->

         <div class="my-contnet-tab-filter justify-between" x-data="{ isFilterModalOpen: false }">

             {{-- filter modal --}}
             <x-modals.modal-box x-show="isFilterModalOpen" heading="Filter">
                 <livewire:widgets.my-content-filter />
             </x-modals.modal-box>

             {{-- search --}}
             <div class="my-content-search">
                 <div class="search-bar-wrapper">
                     <span class="vi-icons search"></span>
                     <input type="search" class="vi-search-bar" placeholder="Search by article name" required=""
                         onchange="searchNotes(this)">
                     <div
                         class="absolute left-0 top-[40px] bg-white rounded-md w-[100%] border-[#8F93A3] border-[1px] z-10 hidden showsearch">
                         <p class="p-[10px] cursor-pointer text-[#5A7184] hover:bg-[#F4F6FC]">Search result
                         <p>
                     </div>
                 </div>
             </div>

             {{-- filter --}}
             <div class="my-content-sort">
                 {{-- <button class="clear-filter">Clear Filter</button> --}}
                 <button class="cont-filter" @click="isFilterModalOpen=true">Filter</button>
                 <a href="javascript:void(0)" class="flex items-center text-[#3362CC] mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none">
                        <path d="M8.99982 12.2847C9.38816 12.2847 9.70294 11.9556 9.70294 11.5496V10.2409H10.9547C11.3431 10.2409 11.6578 9.91184 11.6578 9.50586C11.6578 9.09987 11.3431 8.77077 10.9547 8.77077H9.70294V7.46214C9.70294 7.05615 9.38816 6.72705 8.99982 6.72705C8.61148 6.72705 8.2967 7.05615 8.2967 7.46214V8.77077H7.04492C6.65659 8.77077 6.3418 9.09987 6.3418 9.50586C6.3418 9.91184 6.65659 10.2409 7.04492 10.2409H8.2967V11.5496C8.2967 11.9556 8.61148 12.2847 8.99982 12.2847Z" fill="#3362CC"/>
                        <path d="M17.2969 11.0458C17.6852 11.0458 18 10.7167 18 10.3107V4.85358C18 3.23228 16.7383 1.91324 15.1875 1.91324H8.59057L7.22447 0.699691C6.7166 0.248495 6.06983 0 5.40327 0H2.8125C1.26169 0 0 1.31904 0 2.94034V14.0025C0 15.6238 1.26169 16.9428 2.8125 16.9428H15.1875C16.7383 16.9428 18 15.6238 18 14.0025V13.9861C18 13.5801 17.6852 13.251 17.2969 13.251C16.9085 13.251 16.5938 13.5801 16.5938 13.9861V14.0025C16.5938 14.8131 15.9629 15.4726 15.1875 15.4726H2.8125C2.03709 15.4726 1.40625 14.8131 1.40625 14.0025V2.94034C1.40625 2.12969 2.03709 1.47017 2.8125 1.47017H5.40327C5.73652 1.47017 6.05992 1.5944 6.31385 1.82003L7.87686 3.20854C8.00399 3.32145 8.16536 3.38345 8.33217 3.38345H15.1875C15.9629 3.38345 16.5938 4.04297 16.5938 4.85362V10.3107C16.5938 10.7167 16.9085 11.0458 17.2969 11.0458Z" fill="#3362CC"/>
                    </svg>
                    <span class="ml-2 text-[16px]">Create new folder</span>
                </a>
                <a href="javascript:void(0)" class="flex items-center text-[#3362CC] mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <path d="M3.92969 7.85156H10.5703C10.8939 7.85156 11.1562 7.58922 11.1562 7.26562C11.1562 6.94203 10.8939 6.67969 10.5703 6.67969H3.92969C3.60609 6.67969 3.34375 6.94203 3.34375 7.26562C3.34375 7.58922 3.60609 7.85156 3.92969 7.85156Z" fill="#3362CC" stroke="#3362CC" stroke-width="0.2"/>
                        <path d="M3.92969 11.1719H9.00781C9.33141 11.1719 9.59375 10.9095 9.59375 10.5859C9.59375 10.2623 9.33141 10 9.00781 10H3.92969C3.60609 10 3.34375 10.2623 3.34375 10.5859C3.34375 10.9095 3.60609 11.1719 3.92969 11.1719Z" fill="#3362CC" stroke="#3362CC" stroke-width="0.2"/>
                        <path d="M3.92969 14.1719H9.00781C9.33141 14.1719 9.59375 13.9095 9.59375 13.5859C9.59375 13.2623 9.33141 13 9.00781 13H3.92969C3.60609 13 3.34375 13.2623 3.34375 13.5859C3.34375 13.9095 3.60609 14.1719 3.92969 14.1719Z" fill="#3362CC" stroke="#3362CC" stroke-width="0.2"/>
                        <path d="M10.5703 16H3.92969C3.60609 16 3.34375 16.2623 3.34375 16.5859C3.34375 16.9095 3.60609 17.1719 3.92969 17.1719H10.5703C10.8939 17.1719 11.1562 16.9095 11.1562 16.5859C11.1562 16.2623 10.8939 16 10.5703 16Z" fill="#3362CC" stroke="#3362CC" stroke-width="0.2"/>
                        <path d="M20.8284 11.367L18.4846 9.0232C18.2558 8.79437 17.8848 8.79437 17.656 9.0232C17.4271 9.25203 17.4271 9.62301 17.656 9.85184L18.9995 11.1953H16.2344V5.49219C16.2344 5.3368 16.1727 5.18777 16.0627 5.07789L12.1566 1.17164C12.0468 1.06176 11.8977 1 11.7423 1H3.14844C1.96379 1 1 1.96379 1 3.14844V18.8516C1 20.0362 1.96379 21 3.14844 21H14.0859C15.2706 21 16.2344 20.0362 16.2344 18.8516V12.3672H18.9995L17.656 13.7107C17.4271 13.9395 17.4271 14.3105 17.656 14.5393C17.7704 14.6537 17.9204 14.7109 18.0703 14.7109C18.2203 14.7109 18.3702 14.6537 18.4846 14.5393L20.8284 12.1955C21.0572 11.9668 21.0572 11.5958 20.8284 11.367ZM14.2339 4.90625H12.3281V3.00055L14.2339 4.90625ZM15.0625 18.8516C15.0625 19.39 14.6244 19.8281 14.0859 19.8281H3.14844C2.60996 19.8281 2.17188 19.39 2.17188 18.8516V3.14844C2.17188 2.60996 2.60996 2.17188 3.14844 2.17188H11.1562V5.49219C11.1562 5.81578 11.4186 6.07812 11.7422 6.07812H15.0625V11.1953H11.0391C10.7155 11.1953 10.4531 11.4577 10.4531 11.7812C10.4531 12.1048 10.7155 12.3672 11.0391 12.3672H15.0625V18.8516Z" fill="#3362CC" stroke="#3362CC" stroke-width="0.2"/>
                      </svg>
                    <span class="ml-2 text-[16px]">Export as PDF</span>
                </a>
                 <div class="vi-dropdown">
                     <div class="vi-dropbtn">Time<span class="vi-icons vi-drop-arrow"></span></div>
                     <div class="vi-dropdown-content">
                         <a href="javascript:void(0)">This Year</a>
                         <a href="javascript:void(0)">Last 7 days</a>
                         <a href="javascript:void(0)">Last 15 days</a>
                         <a href="javascript:void(0)">This Month</a>
                         <a href="javascript:void(0)">Last Month</a>
                         <a href="javascript:void(0)">Custom</a>
                         <a href="javascript:void(0)">Clear Filter</a>
                     </div>
                 </div>
                 <div class="change-view-wrap">
                     <!-- <a href="javascript:void(0)"><img src="{{ URL::asset('images/grid.svg') }}"></a> -->
                     <a href="javascript:void(0)"><img src="{{ URL::asset('images/list.svg') }}"></a>
                 </div>
             </div>

         </div>

         <div class="breadcrumb-wrapper" id="breadcrumb">
             <ul>
                 <li><a href="javascript:void(0)" class="{{ $type == 'papers' ? 'active' : '' }}">Paper</a></li>
                 @if ($paper)
                     <li><a href="javascript:void(0)"
                             class="{{ $type == 'topics' ? 'active' : '' }}">{{ $paper }}</a></li>
                 @endif
                 @if ($topic)
                     <li><a href="javascript:void(0)"
                             class="{{ $type == 'sections' ? 'active' : '' }}">{{ $topic }}</a></li>
                 @endif
                 @if ($section)
                     <li><a href="javascript:void(0)"
                             class="{{ $type == 'articles' ? 'active' : '' }}">{{ $section }}</a></li>
                 @endif
             </ul>
         </div>

         <div class="vi-tab-acc-list">
             <div class="vi-acrticle-highligh-coll active">
                 <div class="ci-tab-acc-content">
                     <div class="vi-note-and-high-list" id="notes-list-container">
                         @if ($type == 'papers')
                             @foreach ($papers as $paper)
                                 <div class="vi-note cursor-pointer">
                                     <div class="vi-card-corner">
                                         <div class="vi-card-corner-triangle"></div>
                                     </div>
                                     <div class="vi-note-title flex justify-between">
                                         <a href="{{ route('user.content', ['type' => 'topics']) . '?pid=' . $paper->id }}"
                                             class="flex">
                                             <p class="overflow-hidden text-ellipsis max-w-[250px] whitespace-nowrap">
                                                 {{ $paper->name }}</p>
                                                </a>
                                             <!-- <span class="vi-note-name ml-[10px]">Note 1</span> -->
                                             <!-- Dropdown Newly added -->
                                             <div class="dropdown relative inline-block" id="dropdown1">
                                                <button class="dropdown-button cursor-pointer p-1 text-[#374957] rotate-90 font-bold text-xs tracking-[5px]" onclick="toggleDropdown('dropdown1')">...</button>
                                                <div class="dropdown-content absolute right-0 hidden z-10 bg-white shadow-xl py-2">
                                                    <!-- Dropdown content goes here -->
                                                    <p class="text-[#8F93A3] text-sm font-normal px-4 py-1 cursor-pointer hover:bg-[#F4F6FC]">Rename</p>
                                                    <p class="text-[#8F93A3] text-sm font-normal px-4 py-1 cursor-pointer hover:bg-[#F4F6FC]">Delete</p>
                                                    <p class="text-[#8F93A3] text-sm font-normal px-4 py-1 cursor-pointer hover:bg-[#F4F6FC]">Move</p>
                                                </div>
                                            </div>
                                            <!-- Dropdown Newly added -->
                                     </div>
                                 </div>
                             @endforeach
                         @elseif ($type == 'topics')
                             @foreach ($topics as $topic)
                                 <div class="vi-note cursor-pointer">
                                     <div class="vi-card-corner">
                                         <div class="vi-card-corner-triangle"></div>
                                     </div>
                                     <div class="vi-note-title">
                                         <a href="{{ route('user.content', ['type' => 'sections']) . '?tid=' . $topic->id }}"
                                             class="flex">
                                             <p class="overflow-hidden text-ellipsis max-w-[250px] whitespace-nowrap">
                                                 {{ $topic->name }}</p>
                                             <!-- <span class="vi-note-name ml-[10px]">Note 1</span> -->
                                         </a>
                                     </div>
                                 </div>
                             @endforeach
                         @elseif ($type == 'sections')
                             @foreach ($sections as $section)
                                 <div class="vi-note cursor-pointer">
                                     <div class="vi-card-corner">
                                         <div class="vi-card-corner-triangle"></div>
                                     </div>
                                     <div class="vi-note-title">
                                         <a href="{{ route('user.content', ['type' => 'articles']) . '?sid=' . $section->id }}"
                                             class="flex">
                                             <p class="overflow-hidden text-ellipsis max-w-[250px] whitespace-nowrap">
                                                 {{ $section->name }}</p>
                                             <!-- <span class="vi-note-name ml-[10px]">Note 1</span> -->
                                         </a>
                                     </div>
                                 </div>
                             @endforeach
                         @elseif ($type == 'articles')
                             @foreach ($articles as $article)
                                 <div class="vi-note">
                                     <div class="vi-card-corner">
                                         <div class="vi-card-corner-triangle"></div>
                                     </div>

                                     <div class="vi-note-title">
                                         <a href="javascript:void(0)" class="flex">
                                             <p class="overflow-hidden text-ellipsis max-w-[250px] whitespace-nowrap">
                                                 {{ $article->title }}</p>
                                             <!-- <span class="vi-note-name ml-[10px]">Note 1</span> -->
                                         </a>
                                     </div>
                                     <div class="note-content">
                                         <p class="vi-text-light">
                                             {{ html_entity_decode(substr(strip_tags($article->content), 0, 500)) }}
                                         </p>
                                     </div>
                                     <div class="vi-note-action">
                                         <a href="#" class="vi-icons note-delete"></a>
                                         <a href="#" class="vi-icons note-edit"></a>
                                     </div>
                                 </div>
                             @endforeach
                         @endif
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>
 {{-- @script --}}
 <script>
     function searchNotes(ele) {
         const val = ele.value;
         let url = "{{ route('user.search-notes') }}";
         url += `?query=${val}`;


         getData(url).then(data => {
             let html = ""
             data.map(note => {
                 html += `<div class="vi-note">
                                     <div class="vi-card-corner">
                                         <div class="vi-card-corner-triangle"></div>
                                     </div>

                                     <div class="vi-note-title">
                                         <a href="javascript:void(0)" class="flex">
                                             <p class="overflow-hidden text-ellipsis max-w-[250px] whitespace-nowrap">
                                                 ${note.title}</p>
                                         </a>
                                     </div>
                                     <div class="note-content">
                                         <p class="vi-text-light">
                                            ${note.content}
                                         </p>
                                     </div>
                                     <div class="vi-note-action">
                                         <a href="#" class="vi-icons note-delete"></a>
                                         <a href="#" class="vi-icons note-edit"></a>
                                     </div>
                                 </div>`
             })

             document.getElementById("notes-list-container").innerHTML = html;
             document.getElementById("breadcrumb").style.display = "none"
         })


     }


     // Function to toggle the visibility of the dropdown
    function toggleDropdown(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        var dropdownContent = dropdown.querySelector('.dropdown-content');

        // Close all other dropdowns
        var allDropdowns = document.querySelectorAll('.dropdown');
        allDropdowns.forEach(function(dropdown) {
            var content = dropdown.querySelector('.dropdown-content');
            if (dropdown !== dropdownId && content.style.display === 'block') {
            content.style.display = 'none';
            }
        });

        // Toggle the visibility of the clicked dropdown
        dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-button')) {
            var openDropdowns = document.querySelectorAll('.dropdown-content');
            openDropdowns.forEach(function(dropdown) {
                if (dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
                }
            });
            }
        };
    }
 </script>
 {{-- @endscript --}}
