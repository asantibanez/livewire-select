<div id="options" class="{{ $styles['search'] }}">

    @include($searchInputView, [
        'name' => $name,
        'placeholder' => $placeholder,
        'styles' => $styles,
    ])

    @include($searchOptionsContainer, [
        'options' => $options,
        'emptyOptions' => $emptyOptions,
        'isSearching' => $isSearching,
        'styles' => $styles,
    ])

</div>
