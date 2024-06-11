<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //index
    public function index()
    {
        $category = Category::orderBy('nama', 'asc')->get();

        return view('admin.category.index', compact('category'));
    }

    //create
    public function create()
    {
        return view('admin.category.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        DB::table('category')->insert([
            'nama' => $request->nama
        ]);

        return redirect()->route('admin.category')->with('success', 'Category created successfully.');
    }

    //edit
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $update = [
            'nama' => $request->nama
        ];
        
        Category::whereId($id)->update($update);

        return redirect()->route('admin.category')->with('success', 'Category updated successfully.');
    }

    //destroy
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Category deleted successfully.');
    }
}
