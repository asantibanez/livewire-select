<div class="absolute top-0 left-0 mt-12 w-full">
    @if(!$emptyOptions)
        <div class="w-full bg-white border">
            @foreach($options as $option)
                @include($searchOptionItem, [
                    'option' => $option,
                ])
            @endforeach
        </div>
    @elseif ($isSearching)
        @include($searchNoResultsView)
    @endif
</div>
