<div id="options" class="relative">

    @include('livewire-select::search-input', [
        'name' => $name,
        'placeholder' => $placeholder,
    ])

    @include('livewire-select::search-options-container', [
        'options' => $options,
        'emptyOptions' => $emptyOptions,
        'isSearching' => $isSearching,
    ])
</div>
