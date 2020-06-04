<div class="{{ $styles['searchOptionsContainer'] }}">
    @if(!$emptyOptions)
        @foreach($options as $option)
            @include($searchOptionItem, [
                'option' => $option,
                'styles' => $styles,
            ])
        @endforeach
    @elseif ($isSearching)
        @include($searchNoResultsView, [
            'styles' => $styles,
        ])
    @endif
</div>
