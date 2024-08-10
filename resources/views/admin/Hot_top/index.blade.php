@extends('admin.index')
@section('content')
<div class="container">
    <h1>Hot Deals</h1>

    <!-- Display Success or Error Messages -->
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

    <!-- Link to Create New Hot Deal -->
    <a href="{{ route('hotdeals.create') }}" class="btn btn-primary mb-3">Add New Hot Deal</a>

    <!-- Hot Deals Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Status</th>
                <th>Offer Percentage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hotdeals as $hotdeal)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $hotdeal->product->name }}</td> <!-- Assuming you have a relationship defined in the Hotdeal model -->
                    <td>{{ $hotdeal->status }}</td>
                    <td>{{ $hotdeal->offer_percentage }}%</td>
                    <td>
                        <a href="{{ route('hotdeals.edit', $hotdeal) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('hotdeals.destroy', $hotdeal) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection