<div>

    <div>
        @if(!$searchable && $shouldShow)
            @include($defaultView, [
                'name' => $name,
                'options' => $options,
                'placeholder' => $placeholder,
                'styles' => 'p-2 rounded border w-full appearance-none',
            ])
        @endif
    </div>

    <div>
        @if($searchable && $shouldShow)
            <div>
                @if(!empty($value))
                    @include($searchSelectedOptionView, [
                        'styles' => 'p-2 rounded border w-full bg-white cursor-pointer',
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
                    ])
                @endif
            </div>
        @endif
    </div>

</div>
