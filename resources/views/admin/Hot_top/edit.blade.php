@extends('admin.index')

@section('content')
<div class="container">
    <h1>Edit Hot and Top</h1>

    <!-- Display Success or Error Messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Hot Deal Edit Form -->
    <form method="POST" action="{{ route('hotdeals.update', $hotdeal->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="product_id">Product:</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">Select a Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $hotdeal->product_id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $hotdeal->status) }}" required>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="offer_percentage">Offer Percentage:</label>
            <input type="number" class="form-control" id="offer_percentage" name="offer_percentage" value="{{ old('offer_percentage', $hotdeal->offer_percentage) }}" min="0" max="100" required>
            @error('offer_percentage')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Hot Deal</button>
    </form>
</div>
@endsection