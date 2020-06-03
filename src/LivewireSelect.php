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

    public $value;

    public $searchTerm;

    public $searchable;

    public $dependsOn;

    public $dependsOnValues;

    public function mount($name,
                          $initialValue = null,
                          $searchable = false,
                          $dependsOn = [],
                          $extras = null)
    {
        $this->name = $name;

        $this->value = $initialValue;

        $this->searchable = $searchable;

        $this->dependsOn = $dependsOn;

        $this->dependsOnValues = collect($this->dependsOn)
            ->mapWithKeys(function ($key) {
                return [$key => null];
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
                return ["{$key}Updated" => 'checkDependsOnValues'];
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

    public function checkDependsOnValues($data)
    {
        $name = $data['name'];
        $value = $data['value'];

        if (!$this->hasDependency($name)) {
            return;
        }

        $this->updateDependingValue($name, $value);
    }

    private function updateDependingValue($name, $value)
    {
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

    public function selectValue($value)
    {
        $this->value = $value;

        if ($this->searchable && $this->value == null) {
            $this->emit("focus-search", ['componentId' => $this->id]);
        }

        $this->notifyValueChanged();
    }

    public function render()
    {
        if ($this->searchable) {
            if (!empty($this->searchTerm)) {
                $options = $this->options($this->searchTerm);
            } else {
                $options = collect();
            }
        } else {
            $options = $this->options($this->searchTerm);
        }

        $selectedOption = $this->selectedOption($this->value);

        $listeners = $this->getListeners();

        return view('livewire-select::select')
            ->with([
                'options' => $options,
                'selectedOption' => $selectedOption,
                'componentId' => $this->id,
                'listeners' => $listeners,
            ]);
    }
}
