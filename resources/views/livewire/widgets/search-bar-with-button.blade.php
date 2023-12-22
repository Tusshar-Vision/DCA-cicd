<div class="flex w-5/12 vi-search-bar-wrapper mt-6 items-center">
    <div class="flex w-full rounded-tl-md rounded-bl-md border-2 items-center pl-2 h-10 relative">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-search">
            <circle cx="11" cy="11" r="8" />
            <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <input type="text" class="w-full vi-search-bar h-8 border-none focus:ring-0" placeholder="Search"
            id="searchInput" wire:model="searchTerm" required>
        <div id="search-item-container" class="search-list overflow-scroll" style="display: none">
            <p>Search 1</p>
        </div>
    </div>
    <div>
        <button wire:click="search"
            class="vi-primary-button vi-search-btn h-10 rounded-tr-md rounded-br-md w-32 cursor-pointer flex items-center justify-center">
            Search
        </button>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let query = this.value;
        console.log("valuee", query);

        let url = "{{ url('search') }}";
        url += `/${query}`

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("data", data);
                let html = ""
                data.map(suggestion => {
                    let url = "{{ url('') }}"
                    url +=
                        `${suggestion.path}/${suggestion.published_at}/${suggestion.name}/${suggestion.slug}`
                    html += `<a href="${url}"><p>${suggestion.title}</p><a>`
                })
                document.getElementById("search-item-container").innerHTML = html;
                document.getElementById("search-item-container").style.display = "block"
            })
            .catch(error => console.error('Error fetching suggestions:', error));
    });
</script>
