@extends('admin.index')

@section('content')
<div class="container">
        <h1>Product Details</h1>

        <!-- Display success or error messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Display the product details -->
        <div class="row">
            <div class="col-md-6">
                <!-- Product Image -->
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                @else
                    <p>No image available</p>
                @endif
            </div>

            <div class="col-md-6">
                <!-- Product Information -->
                <h2>{{ $product->name }}</h2>
                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p><strong>Category:</strong> {{ $product->category->name }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Quantity:</strong> {{ $product->quantity }}</p>

                <!-- Action Buttons -->
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection


