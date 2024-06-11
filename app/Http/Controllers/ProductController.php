<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //index
    public function index()
    {
        $product = Product::orderBy('product.nama', 'asc')->join('category', 'category.id', "=", "product.kategori")
            ->select('product.*', 'category.nama as category_nama')
            ->get();

        $category = Product::join('category', 'category.id', "=", "product.kategori")
        ->select('category.id as category_id', 'category.nama as category_nama', DB::raw('COUNT(*) as count'))
        ->groupBy('category.id')
        ->get();

        $product_total = Product::count();

        return view('product.index', compact('product', 'category', 'product_total'));
    }

    //detail
    public function detail($id)
    {
        $product = Product::orderBy('nama', 'asc')
            ->join('category', 'category.id', '=', 'product.kategori')
            ->select('product.*', 'category.nama as category_nama')
            ->where('product.id', $id)
            ->first();

        return view('product.detail', compact('product'));
    }

    public function add_to_cart_single(Request $request)
    {
        return redirect()->route('products')->with('success', 'This product has been added to your cart.');
    }

    //add_to_cart
    public function add_to_cart(Request $request)
    {
        return redirect()->route('product.detail', $request->product_id)->with('success', 'This product has been added to your cart.');
    }
}
