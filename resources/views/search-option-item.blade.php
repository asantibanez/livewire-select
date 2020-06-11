<div
    class="{{ $styles['searchOptionItem'] }}"

    wire:click.stop="selectValue('{{ $option['value'] }}')"

    x-bind:class="{ '{{ $styles['searchOptionItemActive'] }}': selectedIndex === {{ $index }}, '{{ $styles['searchOptionItemInactive'] }}': selectedIndex !== {{ $index }} }"
    x-on:mouseover="selectedIndex = {{ $index }}"
>
    {{ $option['description'] }}
</div>
