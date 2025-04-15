@extends('layouts.admin')
@section('content')
<h2>Manage Recipes</h2> <!-- Changed from Manage Posts to Manage Recipes -->
<a href="{{ route('admin.recipes.create') }}">Create New Recipe</a> <!-- Changed from Create New Post to Create New Recipe -->
<table>
<thead>
<tr>
<th>Title</th>
<th>Content</th>
<th>Created At</th>
</tr>
</thead>
<tbody>
@foreach($recipes as $recipe) <!-- Changed from $posts to $recipes -->
<tr>
<td>{{ $recipe->title }}</td> <!-- Changed from $post to $recipe -->

<td>{{ Str::limit($recipe->content, 50) }}</td> <!-- Changed from $post to $recipe -->
<td>{{ $recipe->created_at }}</td> <!-- Changed from $post to $recipe -->

</tr>
@endforeach
</tbody>
</table>
@endsection