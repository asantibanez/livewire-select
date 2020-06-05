<div
    class="{{ $styles['searchOptionItem'] }}"

    wire:click.stop="selectValue('{{ $option['value'] }}')"

    x-bind:class="{ 'bg-gray-100': selectedIndex === {{ $index }} }"
    x-on:mouseover="selectedIndex = {{ $index }}"
>
    {{ $option['description'] }}
</div>
