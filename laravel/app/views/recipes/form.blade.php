@include('recipes.header')

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

    {{ list_to_checklist($ingredients, 'ingredient', isset($recipe) ? $recipe->ingredients->lists('id') : null) }}


    {{ BootForm::submit('Submit') }}

{{ BootForm::close() }}


