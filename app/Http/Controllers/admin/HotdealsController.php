<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotdeals;
use App\Models\Product;

class HotdealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotdeals = Hotdeals::with('product')->get();
        return view('admin.Hot_top.index', compact('hotdeals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.Hot_top.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'status' => 'required|string|max:255',
            'offer_percentage' => 'required|integer|min:0|max:100',
        ]);

        Hotdeals::create($request->all());

        return redirect()->route('hotdeals.create')->with('success', 'Hotdeal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $hotdeal = Hotdeals::findOrFail($id);
        return view('admin.Hot_top.edit',compact('hotdeal','products'));
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
            'product_id' => 'required|exists:products,id',
            'status' => 'required|string|max:255',
            'offer_percentage' => 'required|integer|min:0|max:100',
        ]);
        $hotdeal = Hotdeals::findOrFail($id);
        $hotdeal->update($validatedData);
    
        return redirect()->route('hotdeals.index')->with('success', 'Hot deal updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
