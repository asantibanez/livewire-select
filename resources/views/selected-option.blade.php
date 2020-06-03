<div
    id="selected-value"
    class="{{ $styles }}"
    wire:click.stop="selectValue(null)">
    {{ data_get($selectedOption, 'title', 'Override selectedOption method for a meaningful description') }}

    <input type="hidden" value="{{ $value }}" name="{{ $name }}">
</div>
