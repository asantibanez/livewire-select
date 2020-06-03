<input
    id="{{ $name }}"
    name="{{ $name }}"
    type="text"
    wire:model.debounce.300ms="searchTerm"
    placeholder="{{ $placeholder }}"
    class="p-2 rounded border w-full rounded"
/>
