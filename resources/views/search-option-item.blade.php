<div
    class="{{ $styles['searchOptionItem'] }}"
    wire:click.stop="selectValue('{{ $option['value'] }}')"
>
    {{ $option['description'] }}
</div>
