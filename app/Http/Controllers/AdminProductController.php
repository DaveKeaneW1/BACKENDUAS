<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    //index
    public function index()
    {
        $product = Product::orderBy('product.nama', 'asc')->join('category', 'category.id', "=", "product.kategori")
            ->select('product.*', 'category.nama as category_nama')
            ->get();

        return view('admin.product.index', compact('product'));
    }

    //create
    public function create()
    {
        $category = Category::orderBy('nama', 'asc')->get();
        return view('admin.product.create', compact('category'));
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'file' => 'required|file',
        ]);

        // Handle file upload and obtain file contents
        $imageData = base64_encode(file_get_contents($request->file('file')->getRealPath()));


        try {
            DB::table('product')->insert([
                'nama' => $request->nama,
                'kategori' => $request->kategori,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'image' => $imageData
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to save product: ' . $e->getMessage());
        }

        return redirect()->route('admin.product')->with('success', 'Product created successfully.');
    }

    //edit
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::orderBy('nama', 'asc')->get();
        return view('admin.product.edit', compact('product', 'category'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required'
        ]);


        try {
            $update = [
                'nama' => $request->nama,
                'kategori' => $request->kategori,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'stok' => $request->stok
            ];

            if ($request->hasFile('file')) {
                $imageData = base64_encode(file_get_contents($request->file('file')->getRealPath()));
                $update["image"] = $imageData;
            }

            Product::whereId($id)->update($update);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to save product: ' . $e->getMessage());
        }


        return redirect()->route('admin.product')->with('success', 'Product updated successfully.');
    }

    //destroy
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('admin.product')->with('success', 'Product deleted successfully.');
    }
}
