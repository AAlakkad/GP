@include('ingredients.header')

<table class="table">
    <tr>
        <th>Name:</th>
        <td>{{ $ingredient->name }}</td>
    </tr>
    <tr>
        <th>Unit:</th>
        <td>{{ $ingredient->unit }}</td>
    </tr>
    <tr>
        <th>Description:</th>
        <td>{{ $ingredient->description }}</td>
    </tr>
</table>
