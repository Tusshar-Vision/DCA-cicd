<div>
    <label>
        <input
            type="search"
            placeholder="Search"
            wire:model="query"
            wire:keydown.enter="search"
            class="search-field"
            @focusout="$wire.query = ''"
        >
    </label>
</div>
