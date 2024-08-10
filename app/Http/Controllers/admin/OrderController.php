<?php

namespace App\Http\Controllers\admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user', 'products')->get();
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $users = User::all();
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        return view('admin.order.create', compact('products','users','subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'user_id' => 'nullable|exists:users,id', // Nullable if guest order
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'phone_number' => 'nullable|string',
            'address' => 'required|string',
            'status' => 'nullable|string',
            'date' => 'nullable|date',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'status' => $request->status,
            'date' => $request->date ?? now()->toDateString(),
            'total_price' => 0, // Initialize total price
            'total_quantity' => 0,
           
        ]);

        // Initialize total price
        $totalPrice = 0;
        $totalQuantity = 0;

        $productIds = array_column($validatedData['products'], 'id');
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        // Attach products to the order and calculate total price
        foreach ($validatedData['products'] as $productData) {
            $product = Product::find($productData['id']);
            if ($product) {
                $quantity = $productData['quantity'];
                $price = $product->price;
                $totalPrice += $quantity * $price;
                $totalQuantity += $quantity;

                // Check if the product already exists in the pivot table
                $existingPivot = $order->products()->where('product_id', $productData['id'])->first();
                if ($existingPivot) {
                    $order->products()->updateExistingPivot($productData['id'], ['quantity' => $quantity]);
                } else {
                    $order->products()->attach($productData['id'], ['quantity' => $quantity]);
                }
            }
        }

        // Update order with total price
        $order->total_price = $totalPrice;
        $order->total_quantity = $totalQuantity;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('user', 'products')->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Update the order
        $order->update([
            'user_id' => $validatedData['user_id'],
        ]);

        // Sync products with the order
        $products = [];
        foreach ($validatedData['products'] as $productData) {
            $products[$productData['id']] = ['quantity' => $productData['quantity']];
        }
        $order->products()->sync($products);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
