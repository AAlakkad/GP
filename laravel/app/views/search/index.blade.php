<h2>Search</h2>

{{ BootForm::open()->post()->action(URL::route('search.index')) }}
    {{ Form::token() }}
    <h3>Select one or more ingredients to display recipes</h3>
    <div class="row">
        @foreach ($ingredients as $ingredient)
        <div class="col-md-3">
            <div class="checkbox">

                <label class="control-label">
                    <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}">
                    {{ $ingredient->name }}
                    <p class="help-block">has ({{ $ingredient->recipes()->count() }}) recipes.</p>
                </label>

            </div>
        </div>
        @endforeach
    </div>

    {{ BootForm::submit('Submit') }}

{{ BootForm::close() }}