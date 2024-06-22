<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    //index
    public function index()
    {
        $product_terbaru = Product::join('order_items', 'product.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->groupBy('product.id')
            ->select('product.*', DB::raw('COUNT(*) as total_orders'))
            ->orderBy('product.id', 'desc')
            ->take(8)
            ->get();

        $product_terlaku = Product::join('order_items', 'product.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->groupBy('product.id')
            ->select('product.*', DB::raw('COUNT(*) as total_orders'))
            ->orderBy('total_orders', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('product_terbaru', 'product_terlaku'));
    }

    public function contact()
    {
        return view('contact');
    }
}
