<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    //index
    public function index(Request $request)
    {
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        $customer = Auth::guard('customer')->user()->id;

        // Initialize base query
        $query = Order::query();

        $query->where('orders.status', '!=', 0);
        $query->where('customer_id', $customer);

        // Filter by category if kategori_id is provided
        if ($request->has('status')) {
            $query->where('orders.status', $request->status);
        }

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function ($query) use ($keyword) {
                $query->where('no_order', 'like', '%' . $keyword . '%');
            });
        }

        // Sorting
        $validSortColumns = ['tanggal_terakhir', 'tanggal_terawal', 'price_asc', 'price_desc'];
        $sort_by = $request->input('sort_by', 'tanggal_terakhir'); // Default sort by name_asc
        if (!in_array($sort_by, $validSortColumns)) {
            $sort_by = 'tanggal_terakhir'; // Default to name_asc if invalid value
        }

        switch ($sort_by) {
            case 'tanggal_terakhir':
                $query->orderBy('orders.tanggal_pemesanan', 'desc');
                break;
            case 'tanggal_terawal':
                $query->orderBy('orders.tanggal_pemesanan', 'asc');
                break;
            case 'price_asc':
                $query->orderBy('orders.total', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('orders.total', 'desc');
                break;
            default:
                $query->orderBy('orders.tanggal_pemesanan', 'desc');
                break;
        }

        // Pagination with items per page
        $items_per_page = $request->input('items_per_page', 10); // Default items per page

        $orders = $query->paginate($items_per_page);


        // Total orders count
        $orders_total = Order::where('orders.status', '!=', 0)->where('customer_id', $customer)->count();

        $query = Order::query();

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('customer', function ($query) use ($keyword) {
                    $query->where('nama', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                })
                    ->orWhere('no_order', 'like', '%' . $keyword . '%');;
            });
        }

        $orders_total = $query->where('orders.status', '!=', 0)->where('customer_id', $customer)->count();

        $status_pemesanan = [
            1 => 'Belum bayar',
            2 => 'Sudah bayar',
            3 => 'Sedang diproses',
            4 => 'Siap diambil',
            5 => 'Sedang dikirim',
            6 => 'Selesai',
        ];

        return view('order.index', compact('orders', 'orders_total', 'status_pemesanan'));
    }

    public function detail($id)
    {
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        //cek jika ada order customer dengan status = 0 (cart)
        $customer = Auth::guard('customer')->user()->id;

        $order = Order::orderBy('id', 'desc')->where('customer_id', $customer)->where('status', '!=', 0)->where('id', $id)->first();

        if (!$order) {
            return redirect()->route('cart')->with('error', 'Pesanan tidak ditemukan.');
        }

        $order = Order::with('orderItems.product')->find($order->id);


        $status_pemesanan = [
            1 => 'Belum bayar',
            2 => 'Sudah bayar',
            3 => 'Sedang diproses',
            4 => 'Siap diambil',
            5 => 'Sedang dikirim',
            6 => 'Selesai',
        ];

        return view('order.detail', compact('order', 'status_pemesanan'));
    }
}
