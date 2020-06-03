<?php

namespace Asantibanez\LivewireSelect;

use Illuminate\Support\Collection;
use Livewire\Component;

/**
 * Class LivewireSelect
 * @package Asantibanez\LivewireSelect
 * @property string $name
 * @property mixed $value
 * @property boolean $searchable
 */
class LivewireSelect extends Component
{
    public $name;
    public $placeholder;

    public $value;

    public $searchable;
    public $searchTerm;

    public $dependsOn;
    public $dependsOnValues;

    public function mount($name,
                          $value = null,
                          $placeholder = 'Select an option',
                          $searchable = false,
                          $dependsOn = [],
                          $dependsOnValues = [],
                          $extras = null)
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

        $this->afterMount($extras);
    }

    public function afterMount($extras = null)
    {
        //
    }

    public function getListeners()
    {
        return collect($this->dependsOn)
            ->mapWithKeys(function ($key) {
                return ["{$key}Updated" => 'updateDependingValue'];
            })
            ->toArray();
    }

    public function options($searchTerm = null) : Collection
    {
        return collect();
    }

    public function selectedOption($value = null)
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
            $this->emit("focus-search", ['name' => $this->name]);
        }

        $this->notifyValueChanged();
    }

    public function updatedValue()
    {
        $this->selectValue($this->value);
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

        $selectedOption = $this->selectedOption($this->value);

        return view('livewire-select::select')
            ->with([
                'options' => $options,
                'selectedOption' => $selectedOption,
            ]);
    }
}
