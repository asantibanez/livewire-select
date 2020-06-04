<input
    id="{{ $name }}"
    name="{{ $name }}"
    type="text"
    wire:model.debounce.300ms="searchTerm"
    placeholder="{{ $placeholder }}"
    class="{{ $styles['searchInput'] }}"
/>
