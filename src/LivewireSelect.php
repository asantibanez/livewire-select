<?php

namespace Asantibanez\LivewireSelect;

use Illuminate\Support\Collection;
use Livewire\Component;

/**
 * Class LivewireSelect
 * @package Asantibanez\LivewireSelect
 * @property string $name
 * @property string $placeholder
 * @property mixed $value
 * @property boolean $searchable
 * @property string $searchTerm
 * @property array $dependsOn
 * @property array $dependsOnValues
 * @property boolean $waitForDependenciesToShow
 * @property string $noResultsMessage
 * @property string $selectView
 * @property string $defaultView
 * @property string $searchView
 * @property string $searchInputView
 * @property string $searchOptionsContainer
 * @property string $searchOptionItem
 * @property string $searchSelectedOptionView
 * @property string $searchNoResultsView
 */
class LivewireSelect extends Component
{
    public $name;
    public $placeholder;

    public $value;
    public $optionsValues;

    public $searchable;
    public $searchTerm;

    public $dependsOn;
    public $dependsOnValues;

    public $waitForDependenciesToShow;

    public $noResultsMessage;

    public $selectView;
    public $defaultView;
    public $searchView;
    public $searchInputView;
    public $searchOptionsContainer;
    public $searchOptionItem;
    public $searchSelectedOptionView;
    public $searchNoResultsView;

    public function mount($name,
                          $value = null,
                          $placeholder = 'Select an option',
                          $searchable = false,
                          $dependsOn = [],
                          $dependsOnValues = [],
                          $waitForDependenciesToShow = false,
                          $noResultsMessage = 'No options found',
                          $selectView = 'livewire-select::select',
                          $defaultView = 'livewire-select::default',
                          $searchView = 'livewire-select::search',
                          $searchInputView = 'livewire-select::search-input',
                          $searchOptionsContainer = 'livewire-select::search-options-container',
                          $searchOptionItem = 'livewire-select::search-option-item',
                          $searchSelectedOptionView = 'livewire-select::search-selected-option',
                          $searchNoResultsView = 'livewire-select::search-no-results',
                          $extras = [])
    {
        $this->name = $name;
        $this->placeholder = $placeholder;

        $this->value = $value;

        $this->searchable = $searchable;
        $this->searchTerm = '';

        $this->dependsOn = $dependsOn;

        $this->dependsOnValues = collect($this->dependsOn)
            ->mapWithKeys(function ($key) use ($dependsOnValues) {
                $value = collect($dependsOnValues)->get($key);

                return [
                    $key => $value,
                ];
            })
            ->toArray();

        $this->waitForDependenciesToShow = $waitForDependenciesToShow;

        $this->noResultsMessage = $noResultsMessage;

        $this->selectView = $selectView;
        $this->defaultView = $defaultView;
        $this->searchView = $searchView;
        $this->searchInputView = $searchInputView;
        $this->searchOptionsContainer = $searchOptionsContainer;
        $this->searchOptionItem = $searchOptionItem;
        $this->searchSelectedOptionView = $searchSelectedOptionView;
        $this->searchNoResultsView = $searchNoResultsView;

        $this->afterMount($extras);
    }

    public function afterMount($extras = [])
    {
        //
    }

    public function options($searchTerm = null) : Collection
    {
        return collect();
    }

    public function selectedOption($value)
    {
        return null;
    }

    public function notifyValueChanged()
    {
        $this->emit("{$this->name}Updated", [
            'name' => $this->name,
            'value' => $this->value,
        ]);
    }

    public function selectValue($value)
    {
        $this->value = $value;

        if ($this->searchable && $this->value == null) {
            $this->emit('livewire-select-focus-search', ['name' => $this->name]);
        }

        if ($this->searchable && $this->value != null) {
            $this->emit('livewire-select-focus-selected', ['name' => $this->name]);
        }

        $this->notifyValueChanged();
    }

    public function updatedValue()
    {
        $this->selectValue($this->value);
    }

    public function getListeners()
    {
        return collect($this->dependsOn)
            ->mapWithKeys(function ($key) {
                return ["{$key}Updated" => 'updateDependingValue'];
            })
            ->toArray();
    }

    public function updateDependingValue($data)
    {
        $name = $data['name'];
        $value = $data['value'];

        $oldValue = $this->getDependingValue($name);

        $this->dependsOnValues = collect($this->dependsOnValues)
            ->put($name, $value)
            ->toArray();

        if ($oldValue != null && $oldValue != $value) {
            $this->value = null;
            $this->searchTerm = null;
            $this->notifyValueChanged();
        }
    }

    public function hasDependency($name)
    {
        return collect($this->dependsOnValues)->has($name);
    }

    public function getDependingValue($name)
    {
        return collect($this->dependsOnValues)->get($name);
    }

    public function isSearching()
    {
        return !empty($this->searchTerm);
    }

    public function allDependenciesMet()
    {
        return collect($this->dependsOnValues)
            ->reject(function ($value) {
                return $value != null;
            })
            ->isEmpty();
    }

    public function styles()
    {
        return [
            'default' => 'p-2 rounded border w-full appearance-none',

            'searchSelectedOption' => 'p-2 rounded border w-full bg-white flex items-center',
            'searchSelectedOptionTitle' => 'w-full text-gray-900 text-left',
            'searchSelectedOptionReset' => 'h-4 w-4 text-gray-500',

            'search' => 'relative',
            'searchInput' => 'p-2 rounded border w-full rounded',
            'searchOptionsContainer' => 'absolute top-0 left-0 mt-12 w-full z-10',

            'searchOptionItem' => 'p-3 hover:bg-gray-100 cursor-pointer text-sm',
            'searchOptionItemActive' => 'bg-indigo-600 text-white font-medium',
            'searchOptionItemInactive' => 'bg-white text-gray-600',

            'searchNoResults' => 'p-8 w-full bg-white border text-center text-xs text-gray-600',
        ];
    }

    public function render()
    {
        if ($this->searchable) {
            if ($this->isSearching()) {
                $options = $this->options($this->searchTerm);
            } else {
                $options = collect();
            }
        } else {
            $options = $this->options($this->searchTerm);
        }

        $this->optionsValues = $options->pluck('value')->toArray();

        if ($this->value != null) {
            $selectedOption = $this->selectedOption($this->value);
        }

        $shouldShow = $this->waitForDependenciesToShow
            ? $this->allDependenciesMet()
            : true;

        $styles = $this->styles();

        return view($this->selectView)
            ->with([
                'options' => $options,
                'selectedOption' => $selectedOption ?? null,
                'shouldShow' => $shouldShow,
                'styles' => $styles,
            ]);
    }
}
