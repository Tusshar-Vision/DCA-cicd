<div class="w-full">
    <label>
        <input
            type="search"
            placeholder="Search"
            wire:model="query"
            wire:keydown.enter="search"
            class="w-full rounded-md"
            @focusout="$wire.query = ''"
        >
    </label>
</div>
