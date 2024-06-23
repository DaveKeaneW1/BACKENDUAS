<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Exception;

class CartController extends Controller
{
    //index
    public function index()
    {
        if (Auth::guard("customer")->check()) {
            //cek jika ada order customer dengan status = 0 (cart)
            $customer = Auth::guard('customer')->user()->id;
            $order = Order::getOrCreateOrder($customer);

            $order = Order::with('orderItems.product')->find($order->id);

            return view('cart.index', compact('order'));
        }

        return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
    }

    public function remove_item_from_cart($id)
    {
        // Ensure the user is authenticated
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        $customerId = Auth::guard('customer')->user()->id;

        $orderItem = OrderItem::where('id', $id)
            ->whereHas('order', function ($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })
            ->first();

        // If order item not found or doesn't belong to the customer, return an error response
        if (!$orderItem) {
            return redirect()->back()->with('error', 'Order item not found or you do not have permission to remove it.');
        }
        // Delete the order item
        $orderItem->delete();

        return redirect()->back()->with('success', 'Order item removed successfully.');
    }

    public function update_order_item_qty(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::guard("customer")->check()) {
            throw redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        $customerId = Auth::guard('customer')->user()->id;

        $orderItem = OrderItem::where('id', $request->input('orderItemId'))
            ->whereHas('order', function ($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })
            ->first();

        // If order item not found or doesn't belong to the customer, return an error response
        if (!$orderItem) {
            throw redirect()->back()->with('error', 'Order item not found or you do not have permission to remove it.');
        }

        $quantity = $request->input('quantity');

        try {
            $product = Product::findOrFail($orderItem->product->id);
        } catch (Exception $e) {
            throw redirect()->back()->with('error', $e->getMessage());
        }

        if ($quantity <= 0) {
            $orderItem->delete();
        } else {
            // Check if the product is in stock
            if ($product->stok <= 0) {
                throw redirect()->back()->with('error', 'Stok untuk produk "' . $orderItem->product->nama . '" tidak tersedia.');
            } else if ($quantity > $product->stok) {
                throw redirect()->back()->with('error', 'Stok untuk produk "' . $orderItem->product->nama . '" tidak cukup.');
            }

            $orderItem->jumlah = $quantity;
            $orderItem->save();
        }


        return response()->json(['success' => true]);
    }

    public function update_shipping(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        // Get the authenticated customer's order (you might adjust this part based on your authentication logic)
        $customer = auth()->guard('customer')->user();
        $order = Order::where('customer_id', $customer->id)->where('status', 0)->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        $order->jenis_pengiriman = $request->shipping_option;
        // Update the order based on the selected shipping option
        if ($request->shipping_option != 1 && $request->shipping_option != 2) {
            // Update for "Ambil di Toko"
            $order->jenis_pengiriman = 1; // Update with appropriate value for in-store pickup
        }

        $order->save();

        return redirect()->back()->with('success', 'Pengiriman berhasil diperbarui.');
    }

    //checkout
    public function checkout()
    {
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }
        //cek jika ada order customer dengan status = 0 (cart)
        $customer = Auth::guard('customer')->user()->id;

        $order = Order::where('customer_id', $customer)->where('status', 0)->first();

        if (!$order) {
            return redirect()->route('cart')->with('error', 'Pesanan tidak ditemukan.');
        }

        $order = Order::with('orderItems.product')->find($order->id);

        return view('cart.checkout', compact('order'));
    }

    //checkout
    public function checkout_process(Request $request)
    {
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        //cek jika ada order customer dengan status = 0 (cart)
        $customer = Auth::guard('customer')->user()->id;

        $order = Order::where('customer_id', $customer)->where('status', 0)->first();

        if (!$order) {
            return redirect()->route('cart')->with('error', 'Pesanan tidak ditemukan.');
        }

        $order->alamat_pengiriman = $request->alamat;
        $order->status = 1;
        $order->tanggal_pemesanan = new DateTime();

        $total = 0;

        foreach ($order->orderItems as $orderItem) {
            $total += $orderItem->jumlah * $orderItem->harga;

            // Reduce the product stock
            $product = Product::findOrFail($orderItem->product->id);
            $product->stok -= $orderItem->jumlah;

            if ($product->stok < 0) {
                return redirect()->route('cart')->with('error', 'Stok untuk produk "' . $orderItem->product->nama . '" tidak cukup.');
            }

            $product->save();
        }

        $order->total = $total;


        $order->save();

        return redirect()->route('cart.confirmation');
    }

    //index
    public function confirmation()
    {
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        //cek jika ada order customer dengan status = 0 (cart)
        $customer = Auth::guard('customer')->user()->id;

        $order = Order::orderBy('id', 'desc')->where('customer_id', $customer)->where('status', 1)->first();

        if (!$order) {
            return redirect()->route('cart')->with('error', 'Pesanan tidak ditemukan.');
        }

        $order = Order::with('orderItems.product')->find($order->id);

        return view('cart.confirmation', compact('order'));
    }
}
