@extends('admin.index')

@section('content')
<h1>Edit Category</h1>
    
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
    
    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Back to Categories</a>
@endsection