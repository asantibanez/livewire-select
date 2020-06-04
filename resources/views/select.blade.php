<div>

    <div>
        @if(!$searchable && $shouldShow)
            @include($defaultView, [
                'name' => $name,
                'options' => $options,
                'placeholder' => $placeholder,
                'styles' => $styles,
            ])
        @endif
    </div>

    <div>
        @if($searchable && $shouldShow)
            <div>
                @if(!empty($value))
                    @include($searchSelectedOptionView, [
                        'styles' => $styles,
                        'selectedOption' => $selectedOption,
                        'value' => $value,
                        'name' => $name,
                    ])
                @else
                    @include($searchView, [
                        'name' => $name,
                        'placeholder' => $placeholder,
                        'options' => $options,
                        'isSearching' => !empty($searchTerm),
                        'emptyOptions' => $options->isEmpty(),
                        'styles' => $styles,
                    ])
                @endif
            </div>
        @endif
    </div>

</div>
