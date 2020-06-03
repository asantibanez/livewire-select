<select
    name="{{ $name }}"
    class="{{ $styles }}"
    wire:model="value">

    <option value="">Select an Option</option>

    @foreach($options as $option)
        <option value="{{ $option['value'] }}">
            {{ $option['description'] }}
        </option>
    @endforeach
</select>
