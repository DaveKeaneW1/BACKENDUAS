<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class homeController extends Controller
{
    //index

    public function index()
    {
        $product_terbaru = Product::orderBy('product.id', 'desc')->join('category', 'category.id', "=", "product.kategori")
            ->select('product.*', 'category.nama as category_nama')
            ->limit(8)
            ->get();

        $product_terlaku = Product::orderBy('product.id', 'desc')->join('category', 'category.id', "=", "product.kategori")
            ->select('product.*', 'category.nama as category_nama')
            ->limit(8)
            ->get();

        return view('home', compact('product_terbaru', 'product_terlaku'));
    }
}
