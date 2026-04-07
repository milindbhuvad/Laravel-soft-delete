<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customers::all();
        return view('index', compact('customers'));
    }

    public function trash($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully.');
    }

    public function trashed()
    {
        $customers = Customers::onlyTrashed()->get();
        return view('trashed', compact('customers'));
    }

    public function delete($id)
    {
        $customer = Customers::onlyTrashed()->findOrFail($id);
        $customer->forceDelete();
        return redirect()->back()->with('success', 'Customer permanently deleted successfully.');
    }

    public function restore($id)
    {
        $customer = Customers::onlyTrashed()->findOrFail($id);
        $customer->restore();
        return redirect()->back()->with('success', 'Customer restored successfully.');
    }
}
