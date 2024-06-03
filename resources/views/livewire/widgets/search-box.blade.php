<div class="w-full">
    <label for="navSearchInput">
        <input
            type="search"
            placeholder="Search"
            id="navSearchInput"
            wire:model="query"
            wire:keydown.enter="search"
            @keydown.escape="document.getElementById('searchCont').classList.remove('inModal')"
            class="w-full rounded-md dark:text-white dark:bg-dark545557"
        >
    </label>
    <div id="nav-search-item-container" class="search-list overflow-scroll bg-white dark:text-white dark:bg-dark545557 p-2" style="display: none;">
    </div>
</div>

<script>
    document.getElementById('navSearchInput').addEventListener('input', function() {
        let query = this.value;
        let url = "{{ url('search') }}";
        url += `/${query}`

        if (query === '') {
            document.getElementById("search-item-container").style.display = "none";
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                let html = ""
                if (data.length > 0) {
                    data.map(suggestion => {
                        html += `
                            <div class="border-b-2 p-2 hover:bg-visionGray">
                                <a href="${suggestion.url}">
                                    <p>${suggestion.title}</p>
                                <a>
                            </div>
                        `
                    });
                    document.getElementById("nav-search-item-container").innerHTML = html;
                    document.getElementById("nav-search-item-container").style.display = "block"
                }
            })
            .catch(error => console.error('Error fetching suggestions:', error));
    });

    document.getElementById('navSearchInput').addEventListener('focusout', function () {
        document.getElementById("search-item-container").style.display = "none";
    });
</script>
