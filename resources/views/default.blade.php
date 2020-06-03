<select
    name="{{ $name }}"
    class="{{ $styles }}"
    wire:model="value">

    <option value="">
        {{ $placeholder }}
    </option>

    @foreach($options as $option)
        <option value="{{ $option['value'] }}">
            {{ $option['description'] }}
        </option>
    @endforeach
</select>
