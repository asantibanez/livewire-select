<select
    name="{{ $name }}"
    class="{{ $styles['default'] }}"
    multiple="true"
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

@push('livewire-select-scripts')
    <script>
        console.log('another lw select script');
    </script>
@endpush
