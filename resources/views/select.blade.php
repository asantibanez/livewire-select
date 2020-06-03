<div>

    <div>
        @if(!$searchable)
            <select
                name="{{ $name }}"
                class="p-2 rounded border w-full appearance-none"
                wire:model="value">

                <option value="">Select an Option</option>

                @foreach($options as $option)
                    <option value="{{ $option['value'] }}">
                        {{ $option['description'] }}
                    </option>
                @endforeach

            </select>
        @endif
    </div>

    <div>
        @if($searchable)
            <div>

                @if(!empty($value))
                    <div
                        class="p-2 rounded border w-full bg-white"
                        wire:click.stop="selectValue(null)">
                        {{ $selectedOption['title'] }}
                    </div>
                @else
                    <form wire:submit.prevent="">
                        <div class="relative">
                            <input
                                id="{{ $componentId }}-search"
                                type="text"
                                wire:model.debounce.300ms="searchTerm"
                                placeholder="Search"
                                class="p-2 rounded border w-full rounded"
                            />

                            <div class="absolute top-0 left-0 mt-12 w-full">
                                @if($options->isNotEmpty())
                                    <ul class="w-full bg-white border">
                                        @foreach($options as $option)
                                            <li
                                                class="p-4 border-b hover:bg-indigo-100 cursor-pointer"
                                                wire:click.stop="selectValue('{{ $option['value'] }}')">
                                                {{ $option['description'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if(!empty($searchTerm) && $options->isEmpty())
                                    <p class="p-8 w-full bg-white border text-center text-sm">
                                        No options found
                                    </p>
                                @endif
                            </div>
                        </div>
                    </form>
                @endif

            </div>
        @endif
    </div>

</div>
