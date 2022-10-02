<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLoanRequest;
use App\Models\Customer;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LoanController extends BaseAPIController
{
    public function index()
    {
        return view('loans');
    }

    public function fetch()
    {
        $loans = Loan::paginate(12);

        return $this->success([
            'loans' => $loans
        ]);
    }

    public function addLoan(AddLoanRequest $request)
    {
        // The request is validated.
        $file = $request->file('bankFile');
        $randomName = Str::random(10) . '.' . $file->extension();
        $uploaded = Storage::disk('public')->put('/bank-files/' . $randomName, $file->getContent());

        if ($uploaded) {
            DB::beginTransaction();

            // Create customer
            $customer = new Customer();
            $customer->name = $request->customer_name;
            $customer->save();

            // Create loan
            $customer->loans()->save(new Loan([
                'amount' => $request->amount,
                'duration' => $request->duration,
                'bank_file' => $randomName,
                'created_by' => auth()->id()
            ]));

            DB::commit();

            return $this->success([
                'customer' => $customer
            ], 'The loan has been added successfully.');
        }

        return $this->fail([], 'Failed to add the loan.');
    }
}
