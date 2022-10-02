<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends BaseAPIController
{
    public function index()
    {
        return view('customers');
    }

    public function fetch()
    {
        $customers = Customer::paginate(10);

        return $this->success([
            'customers' => $customers
        ]);
    }
}
