<div
    class="p-3 border-b hover:bg-gray-100 cursor-pointer"
    wire:click.stop="selectValue('{{ $option['value'] }}')">
    {{ $option['description'] }}
</div>
