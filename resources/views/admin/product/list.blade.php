@extends('admin.index')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Product List</h1>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
             @endif
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                 <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($products as $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $product->name }}</td>
                            <td>tk.{{ number_format($product->price, 2) }}</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px;">
                                @else
                                    No image
                                @endif
                            </td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class=" btn btn-success"><i class="bi bi-eye-fill"></i></a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection




