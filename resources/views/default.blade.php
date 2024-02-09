<select
    name="{{ $name }}"
    class="{{ $styles['default'] }}"
    wire:model="value">

    <option value="">
        {{ $placeholder }}
    </option>

    @foreach($options as $option)
        <option
            value="{{ $option['value'] }}"
            {!! (json_decode($initValueEncoded) && $option['value'] == json_decode($initValueEncoded)) ? 'selected' : '' !!}
        >
            {{ $option['description'] }}
        </option>
    @endforeach
</select>
