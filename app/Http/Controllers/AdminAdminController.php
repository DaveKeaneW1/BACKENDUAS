<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\UniqueEmailForUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminAdminController extends Controller
{
    //index
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();

        return view('admin.admin.index', compact('users'));
    }

    //create
    public function create()
    {
        return view('admin.admin.create');
    }

    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.admin')->with('success', 'Admin created successfully.');
    }

    //edit
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.admin.edit', compact('user'));
    }

    //update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                new UniqueEmailForUpdate($id), // Pass the user ID to the rule
            ],
            'password' => 'nullable|min:8', // Use nullable here since password is optional
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $update = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if ($request->password) {
            $update['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($update);

        return redirect()->route('admin.admin')->with('success', 'Admin updated successfully.');
    }

    //destroy
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.admin')->with('success', 'Admin deleted successfully.');
    }
}
