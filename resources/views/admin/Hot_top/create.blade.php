@extends('admin.index')
@section('content')
<div class="container">
    <h1>Add Hot Deal or Top Sell</h1>

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

    <!-- Hot Deal Form -->
    <form method="POST" action="{{ route('hotdeals.store') }}">
        @csrf

        <div class="form-group">
            <label for="product_id">Product:</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">Select a Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            @error('product_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="top_selling">Top selling</option>
                    <option value="hotdeals">Hotdeals</option>
                </select>
            </div>

        <div class="form-group">
            <label for="offer_percentage">Offer Percentage:</label>
            <input type="number" class="form-control" id="offer_percentage" name="offer_percentage" value="{{ old('offer_percentage', 0) }}" min="0" max="100" required>
            @error('offer_percentage')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Hot Deal</button>
    </form>
</div>
@endsection