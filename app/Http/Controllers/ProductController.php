<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(){
        return Inertia::render('Product/ProductIndex');
    }
    public function create(){
        return Inertia::render('Product/ProductCreate');
    }
}
