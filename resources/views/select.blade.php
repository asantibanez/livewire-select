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

    <div x-data="{
        isOpen: true,
        selectedIndex: -1,
        selectUp(component) {
            if (this.selectedIndex === 0) {
                return
            }
            this.selectedIndex--
        },
        selectDown(component) {
            if (component.data.optionsValues.length - 1 === this.selectedIndex) {
                return
            }
            this.selectedIndex++
        },
        selectIndex(index) {
            this.selectedIndex = index
            this.isOpen = true
        },
        confirmSelection(component) {
            const value = component.data.optionsValues.length === 1
                ? component.data.optionsValues[0]
                : component.data.optionsValues[this.selectedIndex]

            if (!value) {
                return
            }

            component.set('value', value)

            this.selectedIndex = -1
            this.isOpen = true
        },
        removeSelection(component) {
            component.set('value', null)

            this.selectedIndex = -1
            this.isOpen = true
        }
    }" x-on:click.away="isOpen = false">
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
