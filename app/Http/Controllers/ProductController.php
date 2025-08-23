<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        
        return Inertia::render('Product/ProductIndex', [
            'products' => $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'created_at' => $product->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $product->updated_at->format('Y-m-d H:i:s'),
                ];
            })
        ]);
    }

    public function create()
    {
        return Inertia::render('Product/ProductCreate');
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect(route('product.index'))
            ->with('message', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Product/ProductEdit', [
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request,Product $product ){
        $product->update($request->validated());
        return redirect(route('product.index'))
            ->with('message', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('product.index'))
            ->with('message', 'Product deleted successfully');
    }
}
