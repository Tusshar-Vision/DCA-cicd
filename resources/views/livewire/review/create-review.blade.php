<div>
    {{ $this->form }}

    <button wire:click="create" class="px-3 py-2 text-white rounded-md" style="background:#00569e; margin: 20px 0 0 0;">
        Add
    </button>

    <x-filament-actions::modals />
</div>
