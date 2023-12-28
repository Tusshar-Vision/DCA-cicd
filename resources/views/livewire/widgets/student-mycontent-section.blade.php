 <div class="vi-profile-tab-container">
     <div class="my-content-tab-wrapper rounded">

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
                 <div class="vi-dropdown">
                     <div class="vi-dropbtn">Time<span class="vi-icons vi-drop-arrow"></span></div>
                     <div class="vi-dropdown-content">
                         <a href="javascript:void(0)">This Year</a>
                         <a href="javascript:void(0)">Last 7 days</a>
                         <a href="javascript:void(0)">Last 15 days</a>
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
                                     <div class="vi-note-title">
                                         <a href="{{ route('user.content', ['type' => 'topics']) . '?pid=' . $paper->id }}"
                                             class="flex">
                                             <p class="overflow-hidden text-ellipsis max-w-[250px] whitespace-nowrap">
                                                 {{ $paper->name }}</p>
                                             <!-- <span class="vi-note-name ml-[10px]">Note 1</span> -->
                                         </a>
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
 </script>
 {{-- @endscript --}}
