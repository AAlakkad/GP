<div class="col-md-3">
    <h3>{{ $recipe->name }}</h3>
    <p>{{ $recipe->description }}</p>
    {{ link_to_route('recipes.show', 'View recipe', $recipe->id) }}
</div>


