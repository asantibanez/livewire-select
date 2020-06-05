<div
    class="{{ $styles['searchOptionsContainer'] }}"

    x-show="isOpen"
>
    @if(!$emptyOptions)
        @foreach($options as $option)
            @include($searchOptionItem, [
                'option' => $option,
                'index' => $loop->index,
                'styles' => $styles,
            ])
        @endforeach
    @elseif ($isSearching)
        @include($searchNoResultsView, [
            'styles' => $styles,
        ])
    @endif
</div>
