@include('recipes.header')

{{-- dd(array_fetch($recipe->ingredients->toArray(), 'name')) --}}

@if (! isset($recipe))
    {{ BootForm::open()->post()->action(URL::route('recipes.store')) }}
@else
    {{ BootForm::open()->put()->action(URL::route('recipes.show', [$recipe->id])) }}
    {{ BootForm::bind($recipe) }}
@endif

    {{ Form::token() }}

    {{ BootForm::text('Name', 'name') }}
    {{ BootForm::textarea('Description', 'description') }}
    {{ BootForm::textarea('Steps', 'steps') }}

    {{ list_to_ingredients($ingredients, 'ingredient', isset($recipe) ? $recipe->ingredients->lists('unit', 'id') : null) }}


    {{ BootForm::submit('Submit') }}

{{ BootForm::close() }}


