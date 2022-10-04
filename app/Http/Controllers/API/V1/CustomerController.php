<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends APIResponse
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);

        return $this->success([
            'customers' => $customers
        ]);
    }

    public function add(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'customer_name' => 'required|unique:customers,name',
            'email' => 'email'
        ]);

        if (!$validator->passes())
            return $this->fail($validator->errors(), 'Entered form data is not valid.');

        $customer = new Customer();
        $customer->name = $request->customer_name;
        $customer->email = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->save();

        return $this->success([
            'customer' => $customer
        ], 'The customer has been added successfully.');
    }

    public function get($id, Request $request)
    {
        $customer = Customer::where('id', $id)->with('loans', 'loans.schedule')->first();
        if ($customer != null) {
            return $this->success([
                'customer' => $customer
            ]);
        } else {
            return $this->fail([], 'Invalid customer id.');
        }
    }
}
