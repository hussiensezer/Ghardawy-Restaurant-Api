<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {

        $customers = Customer::latest()->paginate(config('setting.LimitPaginate'));

        return view('dashboard.customers.index', compact('customers'));
    }// End Index

}
