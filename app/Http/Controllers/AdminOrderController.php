<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use DateTime;

class AdminOrderController extends Controller
{
    //index
    public function index(Request $request)
    {
        // Initialize base query
        $query = Order::query();

        // Filter by category if kategori_id is provided
        if ($request->has('status')) {
            $query->where('orders.status', $request->status);
        }

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('customer', function ($query) use ($keyword) {
                    $query->where('nama', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                })
                ->orWhere('no_order', 'like', '%' . $keyword . '%');
                ;
            });
        }

        // Sorting
        $validSortColumns = ['tanggal_terakhir', 'tanggal_terawal'];

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
            default:
                $query->orderBy('orders.tanggal_pemesanan', 'desc');
                break;
        }

        // Pagination with items per page
        $items_per_page = $request->input('items_per_page', 10); // Default items per page

        $orders = $query->paginate($items_per_page);


        // Total products count
        $query = Order::query();

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('customer', function ($query) use ($keyword) {
                    $query->where('nama', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                })
                ->orWhere('no_order', 'like', '%' . $keyword . '%');
                ;
            });
        }

        $orders_total = $query->count();

        $status_pemesanan = [
            1 => 'Belum bayar',
            2 => 'Sudah bayar',
            3 => 'Sedang diproses',
            4 => 'Siap diambil',
            5 => 'Sedang dikirim',
            6 => 'Selesai',
            0 => 'Keranjang'
        ];

        return view('admin.orders.index', compact('orders', 'orders_total', 'status_pemesanan'));
    }

    public function detail($id)
    {
        $order = Order::orderBy('id', 'desc')->where('id', $id)->first();

        if (!$order) {
            return redirect()->route('admin.orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        $order = Order::with('orderItems.product')->find($order->id);


        $status_pemesanan = [
            1 => 'Belum bayar',
            2 => 'Sudah bayar',
            3 => 'Sedang diproses',
            4 => 'Siap diambil',
            5 => 'Sedang dikirim',
            6 => 'Selesai',
            0 => 'Keranjang'
        ];

        return view('admin.orders.detail', compact('order', 'status_pemesanan'));
    }

    public function ubah_status($id)
    {
        $order = Order::orderBy('id', 'desc')->where('id', $id)->first();

        if (!$order) {
            return redirect()->route('admin.orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        $order = Order::with('orderItems.product')->find($order->id);


        $status_pemesanan = [
            1 => 'Belum bayar',
            2 => 'Sudah bayar',
            3 => 'Sedang diproses',
            4 => 'Siap diambil',
            5 => 'Sedang dikirim',
            6 => 'Selesai',
            0 => 'Keranjang'
        ];

        return view('admin.orders.ubah_status', compact('order', 'status_pemesanan'));
    }

    //update
    public function ubah_status_process(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        // $status_pemesanan = [
        //     1 => 'Belum bayar',
        //     2 => 'Sudah bayar',
        //     3 => 'Sedang diproses',
        //     4 => 'Siap diambil',
        //     5 => 'Sedang dikirim',
        //     6 => 'Selesai',
        //     0 => 'Keranjang'
        // ];

        try {
            $status = $request->status;

            $update = [
                'status' => $request->status
            ];

            if ($status == 1) {
                $update["tanggal_pembayaran"] = new DateTime();
            } else if ($status == 6) {
                $update["tanggal_pengiriman"] = new DateTime();
            }

            Order::whereId($id)->update($update);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to save product: ' . $e->getMessage());
        }


        return redirect()->route('admin.orders')->with('success', 'Orders updated successfully.');
    }
}
