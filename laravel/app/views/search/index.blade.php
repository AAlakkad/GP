<h2>Search</h2>

<p>select one or more ingredients to display recipes:</p>
<div class="row">
    @foreach ($ingredients as $ingredient)
    <div class="col-md-3">
        <div class="checkbox">
            <label class="control-label">
                <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}" class="ingredient" {{ in_array($ingredient->id, $selected) ? "checked" : "" }}>
                {{ $ingredient->name }}
                <p class="help-block">has ({{ $ingredient->recipes()->count() }}) recipes.</p>
            </label>
        </div>
    </div>
    @endforeach
</div>
<input type="button" id="submit" value="Search" class="btn btn-primary">

@if(isset($results))
    <hr>
    @if(count($results))
        <div class="row">
            @foreach ($results as $recipe)
                @include('search._recipe', ['recipe' => $recipe])
            @endforeach
        </div>
    @else
        <div class="alert alert-warning">No results found.</div>
    @endif

@endif

@if(isset($suggestions))
    <h3>You might like: </h3>
    <div class="row">
        @foreach ($suggestions as $recipe)
            @include('search._recipe', ['recipe' => $recipe])
        @endforeach
    </div>
@endif

<script src="/assets/js/jquery.js"></script>
<script>
$(document).ready(function(){
    $('#submit').click(function(){
        var ids = [];
        $(".ingredient:checked").each(function() {
            val = $(this).val();
            ids.push($(this).val());
        });
        if(ids !== undefined) {
            var newLocation = window.location.origin + '/search/' + ids.join();
            window.location = newLocation;
        }
    });
});
</script>
