@include('ingredients.header')
{{ link_to_route('ingredients.create', 'New', [], ['class' => 'btn btn-default']) }}

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Ingredient</th>
            <th width="10%">Unit</th>
            <th width="1">Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ingredients as $ingredient)
        <tr>
            <td>{{ link_to_route('ingredients.show', $ingredient->name, $ingredient->id) }}</td>
            <td>{{ $ingredient->unit }}</td>
            <td>{{ link_to_route('ingredients.edit', 'Edit', $ingredient->id) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $ingredients->links(); }}
