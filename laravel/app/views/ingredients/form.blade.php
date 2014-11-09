@include('ingredients.header')

@if (! isset($ingredient))
    {{ BootForm::open()->post()->action(URL::route('ingredients.store')) }}
@else
    {{ BootForm::open()->put()->action(URL::route('ingredients.show', [$ingredient->id])) }}
    {{ BootForm::bind($ingredient) }}
@endif

    {{ Form::token() }}

    {{ BootForm::text('Name', 'name') }}
    {{ BootForm::text('Unit', 'unit') }}
    {{ BootForm::textarea('Description', 'description') }}

    {{ BootForm::submit('Submit') }}

{{ BootForm::close() }}
