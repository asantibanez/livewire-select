<div id="options" class="relative">

    @include($searchInputView, [
        'name' => $name,
        'placeholder' => $placeholder,
    ])

    @include($searchOptionsContainer, [
        'options' => $options,
        'emptyOptions' => $emptyOptions,
        'isSearching' => $isSearching,
    ])

</div>
