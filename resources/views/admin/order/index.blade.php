@extends('admin.index')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Order List</h1>
            <a href="{{ route('orders.create') }}" class="btn btn-primary">Add Order</a>
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
                    <th>Order Name</th>
                    <th>Phone Numder</th>
                    <th>Quntity</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone_number }}</td>
                        <td>{{ $order->total_quantity }} </td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->created_at->format('Y-m-d  H:i:s') }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
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
    </div>
@endsection
