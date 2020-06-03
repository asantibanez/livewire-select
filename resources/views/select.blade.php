<div>

    <div>
        @if(!$searchable && $shouldShow)
            @include('livewire-select::default', [
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
                    @include('livewire-select::selected-option', [
                        'styles' => 'p-2 rounded border w-full bg-white cursor-pointer',
                        'selectedOption' => $selectedOption,
                        'value' => $value,
                        'name' => $name,
                    ])
                @else
                    @include('livewire-select::search', [
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
