<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Product/ProductIndex');
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
}
