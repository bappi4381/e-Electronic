@extends('admin.index')

@section('content')
<div class="container">
        <h1>Create New Order</h1>

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

        <!-- Order Creation Form -->
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id">User</label>
                <select id="user_id" name="user_id" class="form-control" required>
                    <option value="">Select a user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email ">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="Phone Number ">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" rows="3" placeholder="Address">{{ old('address') }}</textarea>
            </div>

            <div class="form-group">
                <label for="products">Products</label>
                <div id="products">
                    <div class="product-row">
                        <select name="products[0][id]" class="form-control" required>
                            <option value="">Select a product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="products[0][quantity]" class="form-control mt-2" placeholder="Quantity" required min="1">
                        <button type="button" class="btn btn-danger mt-2 remove-product-row">Remove</button>
                    </div>
                </div>
                <button type="button" class="btn btn-primary mt-3" id="add-product-row">Add Another Product</button>
                @error('products')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', now()->toDateString()) }}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="shipped">Shipped</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- JavaScript to handle adding/removing product rows -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let productRowCount = 1;

            document.getElementById('add-product-row').addEventListener('click', function () {
                const productRow = `
                    <div class="product-row mt-2">
                        <select name="products[${productRowCount}][id]" class="form-control" required>
                            <option value="">Select a product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="products[${productRowCount}][quantity]" class="form-control mt-2" placeholder="Quantity" required min="1">
                        <button type="button" class="btn btn-danger mt-2 remove-product-row">Remove</button>
                    </div>
                `;
                document.getElementById('products').insertAdjacentHTML('beforeend', productRow);
                productRowCount++;
            });

            document.getElementById('products').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-product-row')) {
                    e.target.closest('.product-row').remove();
                }
            });
        });
    </script>
@endsection



