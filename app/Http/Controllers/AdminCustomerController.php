<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Rules\UniqueEmailForUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminCustomerController extends Controller
{
    //index
    public function index()
    {
        $customers = Customer::orderBy('nama', 'asc')->get();

        return view('admin.customer.index', compact('customers'));
    }

    //create
    public function create()
    {
        return view('admin.customer.create');
    }

    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:8',
            'noHp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Validation passed, create the customer
        Customer::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'noHp' => $request->noHp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.customer')->with('success', 'Customer created successfully.');
    }

    //edit
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.customer.edit', compact('customer'));
    }

    //update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                new UniqueEmailForUpdate($id), // Pass the user ID to the rule
            ],
            'password' => 'nullable|min:8', // Use nullable here since password is optional
            'noHp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $update = [
            'nama' => $request->nama,
            'email' => $request->email,
            'noHp' => $request->noHp,
            'alamat' => $request->alamat,
        ];

        if ($request->password) {
            $update['password'] = Hash::make($request->password);
        }

        Customer::whereId($id)->update($update);

        return redirect()->route('admin.customer')->with('success', 'Customer updated successfully.');
    }

    //destroy
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->route('admin.customer')->with('success', 'Customer deleted successfully.');
    }
}
