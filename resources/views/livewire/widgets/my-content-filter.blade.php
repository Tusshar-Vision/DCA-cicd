<div>
    <label class="mt-[20px] mb-[10px] text-[#5A7184] text-sm flex">Paper</label>
    <select class="rounded-md mb-[20px] broder-[#C3CAD9] text-[#5A7184] w-full" id="papers"
        onchange="showSubjects(this.value)">
    </select>

    <label class="mb-[10px] mt-[20px] text-[#5A7184] text-sm flex">Subject</label>
    <select class="rounded-md mb-[20px] broder-[#C3CAD9] text-[#5A7184] w-full" id="subjects"
        onchange="showSections(this.value)">
    </select>

    <label class="mb-[10px] mt-[20px] text-[#5A7184] text-sm flex">Section</label>
    <select class="rounded-md mb-[20px] broder-[#C3CAD9] text-[#5A7184] w-full" id="sections">
    </select>

    <div class="flex justify-end">
        <button
            class="vi-outline-button h-10 mr-[15px] rounded-tr-md rounded-br-md w-32 cursor-pointer flex items-center justify-center">Cancel</button>
        <button
            class="vi-primary-button vi-search-btn h-10 rounded-tr-md rounded-br-md w-32 cursor-pointer flex items-center justify-center"
            onclick="showNotes()" @click="isFilterModalOpen=false;">Apply</button>
    </div>
</div>

@push('scripts')
    <script>
        getData("{{ route('papers') }}").then(data => {
            let html = ""
            data.map(paper => {
                html += `<option value="${paper.id}">${paper.name}</option>`
            })
            document.getElementById("papers").innerHTML = html;
            showSubjects(document.getElementById("papers").value)
        })

        function showSubjects(paper_id) {
            let url = "{{ url('subjects') }}";
            url += `/${paper_id}`
            getData(url).then(data => {
                let html = ""
                data.map(sub => {
                    html += `<option value="${sub.id}">${sub.name}</option>`
                })
                document.getElementById("subjects").innerHTML = html;
                showSections(document.getElementById("subjects").value)
            }).catch(error => {
                document.getElementById("subjects").innerHTML = null
            })
        }

        function showSections(sub_id) {
            let url = "{{ url('sections') }}";
            url += `/${sub_id}`
            getData(url).then(data => {
                let html = ""
                data.map(sec => {
                    html += `<option value="${sec.id}">${sec.name}</option>`
                })
                document.getElementById("sections").innerHTML = html;
            }).catch(error => {
                document.getElementById("sections").innerHTML = null
            })
        }

        function showNotes() {
            const topic_id = document.getElementById("subjects").value
            const section_id = document.getElementById("sections").value
            console.log('values', topic_id, section_id)

            let url = "{{ url('user/filter-notes') }}";
            url += `/${topic_id}/${section_id}`
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
@endpush
