<div class="absolute top-0 left-0 mt-12 w-full">
    @if(!$emptyOptions)
        <div class="w-full bg-white border">
            @foreach($options as $option)
                @include('livewire-select::search-option-item', [
                    'option' => $option,
                ])
            @endforeach
        </div>
    @elseif ($isSearching)
        <p class="p-8 w-full bg-white border text-center text-sm">
            No options found
        </p>
    @endif
</div>
