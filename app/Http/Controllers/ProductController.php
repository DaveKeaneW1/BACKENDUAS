<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //index
    public function index(Request $request)
    {
        // Initialize base query
        $query = Product::query();

        // Join with category table and select necessary columns
        $query->join('category', 'category.id', '=', 'product.kategori')
            ->select('product.*', 'category.nama as category_nama');

        // Filter by category if kategori_id is provided
        if ($request->has('kategori_id')) {
            $query->where('product.kategori', $request->kategori_id);
        }

        // Sorting
        $validSortColumns = ['name_asc', 'name_desc', 'price_asc', 'price_desc'];
        $sort_by = $request->input('sort_by', 'name_asc'); // Default sort by name_asc
        if (!in_array($sort_by, $validSortColumns)) {
            $sort_by = 'name_asc'; // Default to name_asc if invalid value
        }

        switch ($sort_by) {
            case 'name_asc':
                $query->orderBy('product.nama', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('product.nama', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('product.harga', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('product.harga', 'desc');
                break;
            default:
                $query->orderBy('product.nama', 'asc');
                break;
        }

        // Pagination with items per page
        $items_per_page = $request->input('items_per_page', 12); // Default items per page
        $product = $query->paginate($items_per_page);


        // Total products count
        $product_total = Product::count();

        $category = Product::join('category', 'category.id', "=", "product.kategori")
            ->select('category.id as category_id', 'category.nama as category_nama', DB::raw('COUNT(*) as count'))
            ->groupBy('category.id')
            ->get();

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

    public function add_to_cart_single($id)
    {
        if (Auth::guard("customer")->check()) {
            // Check if product exists
            try {
                $product = Product::findOrFail($id);
            } catch (Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }

            //cek jika ada order customer dengan status = 0 (cart)
            $customer = Auth::guard('customer')->user()->id;
            $order = Order::getOrCreateOrder($customer);


            // Check if an OrderItem with the product already exists for this Order
            $orderItem = $order->orderItems()->where('product_id', $id)->first();

            $cek_stok = 0;
            if ($orderItem) {
                $cek_stok = $orderItem->jumlah + 1;
            } else {
                $cek_stok = 1;
            }

            // Check if the product is in stock
            if ($product->stok <= 0) {
                return redirect()->back()->with('error', 'Stok untuk produk "' . $orderItem->product->nama . '" tidak tersedia.');
            } else if ($cek_stok > $product->stok) {
                return redirect()->back()->with('error', 'Stok untuk produk "' . $orderItem->product->nama . '" tidak cukup.');
            }

            // Begin a database transaction
            DB::beginTransaction();

            if ($orderItem) {
                // If OrderItem exists, update the quantity (jumlah)
                $orderItem->jumlah += 1;
                $orderItem->save();
            } else {
                // Create a new OrderItem
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'jumlah' => 1,
                    'harga' => $product->harga
                ]);
            }

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Produk telah ditambahkan ke keranjang belanja');
        }

        return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
    }

    //add_to_cart
    public function add_to_cart(Request $request)
    {
        if (Auth::guard("customer")->check()) {
            // Check if product exists
            $product_id = $request->product_id;
            $jumlah = $request->quantity;

            if ($jumlah == 0) {
                return redirect()->back()->with('error', "Jumlah produk tidak boleh kosong.");
            }

            try {
                $product = Product::findOrFail($product_id);
            } catch (Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }

            //cek jika ada order customer dengan status = 0 (cart)
            $customer = Auth::guard('customer')->user()->id;
            $order = Order::getOrCreateOrder($customer);

            // Check if an OrderItem with the product already exists for this Order
            $orderItem = $order->orderItems()->where('product_id', $product_id)->first();

            $cek_stok = 0;
            if ($orderItem) {
                $cek_stok = $orderItem->jumlah + $jumlah;
            } else {
                $cek_stok = $jumlah;
            }

            // Check if the product is in stock
            if ($product->stok <= 0) {
                return redirect()->back()->with('error', 'Stok untuk produk "' . $orderItem->product->nama . '" tidak tersedia.');
            } else if ($cek_stok > $product->stok) {
                return redirect()->back()->with('error', 'Stok untuk produk "' . $orderItem->product->nama . '" tidak cukup.');
            }

            // Begin a database transaction
            DB::beginTransaction();


            if ($orderItem) {
                // If OrderItem exists, update the quantity (jumlah)
                $orderItem->jumlah += $jumlah;
                $orderItem->save();
            } else {
                // Create a new OrderItem
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product_id,
                    'jumlah' => $jumlah,
                    'harga' => $product->harga
                ]);
            }

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Produk telah ditambahkan ke keranjang belanja');
        }

        return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
    }
}
