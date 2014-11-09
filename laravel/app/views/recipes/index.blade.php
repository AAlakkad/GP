@include('recipes.header')
{{ link_to_route('recipes.create', 'New', [], ['class' => 'btn btn-default']) }}

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Ingredient</th>
            <th width="1">Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($recipes as $recipe)
        <tr>
            <td>{{ link_to_route('recipes.show', $recipe->name, $recipe->id) }}</td>
            <td>{{ link_to_route('recipes.edit', 'Edit', $recipe->id) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $recipes->links(); }}
