@include('recipes.header')

<table class="table">
    <tr>
        <th>Recipe:</th>
        <td>{{ $recipe->name }}</td>
    </tr>
    <tr>
        <th>Description:</th>
        <td>{{ nl2br($recipe->description) }}</td>
    </tr>
    <tr>
        <th>Ingredients:</th>
        <td>
            @foreach($recipe->ingredients()->get() as $ingredient)
                - {{ $ingredient->name }}<br>
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Steps:</th>
        <td>{{ nl2br($recipe->steps) }}</td>
    </tr>
</table>
