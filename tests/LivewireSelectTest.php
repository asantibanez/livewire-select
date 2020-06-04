<?php

namespace Asantibanez\LivewireSelect\Tests;

use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\LivewireManager;
use Livewire\Testing\TestableLivewire;

class LivewireSelectTest extends TestCase
{
    use WithFaker;

    private function createComponent($parameters) : TestableLivewire
    {
        return app(LivewireManager::class)->test(LivewireSelect::class, $parameters);
    }

    /** @test */
    public function can_create_component_with_required_parameters()
    {
        //Arrange
        $name = $this->faker->name;

        //Act
        $component = $this->createComponent([
            'name' => $name,
        ]);

        //Assert
        $this->assertNotNull($component);

        $component->assertSet('name', $name);
        $component->assertSet('value', null);
        $component->assertSet('placeholder', 'Select an option');

        $component->assertSet('searchable', false);
        $component->assertSet('searchTerm', '');

        $component->assertSet('dependsOn', []);
        $component->assertSet('dependsOnValues', []);

        $component->assertSet('waitForDependenciesToShow', false);

        $component->assertSet('selectView', 'livewire-select::select');
        $component->assertSet('defaultView', 'livewire-select::default');
        $component->assertSet('searchView', 'livewire-select::search');
        $component->assertSet('searchInputView', 'livewire-select::search-input');
        $component->assertSet('searchOptionsContainer', 'livewire-select::search-options-container');
        $component->assertSet('searchOptionItem', 'livewire-select::search-option-item');
        $component->assertSet('searchSelectedOptionView', 'livewire-select::search-selected-option');
        $component->assertSet('searchNoResultsView', 'livewire-select::search-no-results');
    }
}
