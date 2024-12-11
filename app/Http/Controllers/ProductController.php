<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search');
        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%$search%");
        })->get();

        return view('user.home', compact('products'));
    }

    public function menu(Request $request)
    {
        $search = $request->query('search');
        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%$search%");
        })->get();

        return view('admin.menu', compact('products'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'image' => 'required|string',
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'detail' => 'required|string',
    ]);

    Product::create($validated);

    return redirect()->route('menu.index')->with('success', 'Product added successfully.');
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'image' => 'required|string',
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'detail' => 'required|string',
    ]);

    $product->update($validated);

    return redirect()->route('menu.index')->with('success', 'Product updated successfully.');
}

}
