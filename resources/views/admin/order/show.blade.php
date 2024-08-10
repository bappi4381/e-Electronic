@extends('admin.index')

@section('content')
<div class="container">
    <h1>Order Details</h1>

    <div class="card">
        <div class="card-header">
            Order #{{ $order->id }}
        </div>

        <div class="card-body">
            <h5 class="card-title">Customer Information</h5>
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone_number}}</p>
            <p><strong>Address :</strong> {{ $order->address}}</p>

            <h5 class="card-title mt-4">Order Information</h5>
            <p><strong>Date:</strong> {{ $order->created_at->format('F d, Y') }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>

            <h5 class="card-title mt-4">Products</h5>
            @if($order->products->isNotEmpty())
                <ul class="list-group">
                    @foreach ($order->products as $product)
                        <li class="list-group-item">
                            <strong>{{ $product->name }}</strong> - {{ $product->pivot->quantity }} x Tk {{ number_format($product->price, 2) }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No products found for this order.</p>
            @endif

            <h5 class="card-title mt-4">Total Amount</h5>
            <p><strong>Tk.{{ number_format($order->total_price, 2) }}/= </strong></p>
        </div>
    </div>

    <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3">Back to Orders</a>
</div>
@endsection