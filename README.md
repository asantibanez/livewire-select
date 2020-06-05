# Livewire Select

Livewire component for dependant and/or searchable select inputs

### Preview

![preview](https://github.com/asantibanez/livewire-select/raw/master/preview.gif) 

### Installation

You can install the package via composer:

```bash
composer require asantibanez/livewire-select
```

### Requirements

This package uses `livewire/livewire` (https://laravel-livewire.com/) under the hood.

It also uses TailwindCSS (https://tailwindcss.com/) for base styling. 

Please make sure you include both of these dependencies before using this component. 

### Usage

In order to use this component, you must create a new Livewire component that extends from 
`LivewireSelect`

You can use `make:livewire` to create a new component. For example.
``` bash
php artisan make:livewire CarModelSelect
```

In the `CarModelSelect` class, instead of extending from the base Livewire `Component` class, 
extend from `LivewireSelect` class. Also, remove the `render` method. 
You'll have a class similar to this snippet.
 
``` php
class CarModelSelect extends LivewireSelect
{
    //
}
```

In this class, you must override the following methods to provide options for your select input
```php
public function options($searchTerm = null) : Collection 
{
    //
}
```

`options()` must return a collection of keyed values array items that must have at least the following 
keys: `value` and `description`. For example:

```php
public function options($searchTerm = null) : Collection 
{
    return collect([
        [
            'value' => 'honda',
            'description' => 'Honda',
        ],
        [
            'value' => 'mazda',
            'description' => 'Mazda',
        ],
        [
            'value' => 'tesla',
            'description' => 'Tesla',
        ],       
    ]);
}
```

To render the component in a view, just use the Livewire tag or include syntax
 
 ```blade
 <livewire:car-brand-select
    name="car_brand_id"
    :value="$initialValue" // optional
    placeholder="Choose a Car Brand" // optional
 />
 ```

You'll see on screen a select input with some custom styles with your defined values

![preview](https://github.com/asantibanez/livewire-select/raw/master/basic.gif)

Nothing fancy there. Now, let's make another select input depend on its value.

Create another component following the same process above. In this case, we will create 
a `CarModelSelect` with the following `options()` method.

```php
// In CarModelSelect component
public function options($searchTerm = null) : Collection 
{
    $modelsByBrand = [
        'tesla' => [
            ['value' => 'Model S', 'description' => 'Model S'],
            ['value' => 'Model 3', 'description' => 'Model 3'],
            ['value' => 'Model X', 'description' => 'Model X'],
        ],
        'honda' => [
            ['value' => 'CRV', 'description' => 'CRV'],
            ['value' => 'Pilot', 'description' => 'Pilot'],
        ],
        'mazda' => [
            ['value' => 'CX-3', 'description' => 'CX-3'],
            ['value' => 'CX-5', 'description' => 'CX-5'],
            ['value' => 'CX-9', 'description' => 'CX-9'],
        ],
    ];

    $carBrandId = $this->getDependingValue('car_brand_id');

    if ($this->hasDependency('car_brand_id') && $carBrandId != null) {
        return collect(data_get($modelsByBrand, $carBrandId, []));
    }

    return collect([
        ['value' => 'Model S', 'description' => 'Tesla - Model S'],
        ['value' => 'Model 3', 'description' => 'Tesla - Model 3'],
        ['value' => 'Model X', 'description' => 'Tesla - Model X'],
        ['value' => 'CRV', 'description' => 'Honda - CRV'],
        ['value' => 'Pilot', 'description' => 'Honda - Pilot'],
        ['value' => 'CX-3', 'description' => 'Mazda - CX-3'],
        ['value' => 'CX-5', 'description' => 'Mazda - CX-5'],
        ['value' => 'CX-9', 'description' => 'Mazda - CX-9'],
    ]);
} 
```

and define it in the view like this

```blade
<livewire:car-model-select
    name="car_model_id"
    placeholder="Choose a Car Model"
    :depends-on="['car_brand_id']"
/>
```

With these two snippets we have defined a select input that `depends-on` another
select input with name `car_brand_id`. With this definition, we tell our component
to listen to any updates on our `car_brand_id` input and be notified on changes.

![preview](https://github.com/asantibanez/livewire-select/raw/master/dependant.gif)

Notice in the `options()` method the use of two other helper methods: 
`getDependingValue` and `hasDependency`. 

`getDependingValue('token')` will return the value of another field, in this case 
`car_brand_id`. If `car_brand_id` has no value, then it will return `null`.

`hasDependency('token')` allows us to check if our component has been specified
to depend on other component values. This allows us to reuse the component by checking
if a dependency has been specified in our layouts. 

For example if we define the same component without the `:depends-on` attribute,
we can use the component and return all car models.

```blade
<livewire:car-model-select
    name="car_model_id"
    placeholder="Choose a Car Model"
/>
```

It should look something like this

![preview](https://github.com/asantibanez/livewire-select/raw/master/no-dependency.gif)

### Searchable inputs

You can define the `searchable` attribute on the component to change the behavior of your
inputs. With `:searchable="true"` your component will change its behavior to allow searching
the options returned in the `options()` method.

 ```blade
<livewire:car-model-select
    name="car_model_id"
    placeholder="Choose a Car Model"
    :searchable="true"
/>
```

Your input will look something like this

![preview](https://github.com/asantibanez/livewire-select/raw/master/searchable.gif)

To filter the options in the dropdown, you can use the `$searchTerm` parameter in the 
`options()` method.

### Customizing the UI

// TODO 😬

### Advanced behavior

// TODO 😬

### AlpineJs support

Add AlpineJs for arrow-keys navigation, enter key for selection, enter/space keys for reset. 😎

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email santibanez.andres@gmail.com instead of using the issue tracker.

## Credits

- [Andrés Santibáñez](https://github.com/asantibanez)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
