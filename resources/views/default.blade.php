<select
    name="{{ $name }}"
    class="{{ $styles['default'] }}"
    wire:model.live="value">

    <option value="">
        {{ $placeholder }}
    </option>

    @foreach($options as $option)
        <option value="{{ $option['value'] }}">
            {{ $option['description'] }}
        </option>
    @endforeach
</select>
