@extends('admin.index')

@section('content')
<div class="container">
    <h1>SubCategories</h1>
    <a href="{{ route('subcategories.create') }}" class="btn btn-primary">Create New SubCategory</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subCategories as $subCategory)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $subCategory->name }}</td>
                    <td>{{ $subCategory->category->name }}</td>
                    <td>
                        <a href="{{ route('subcategories.edit', $subCategory) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('subcategories.destroy', $subCategory) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection