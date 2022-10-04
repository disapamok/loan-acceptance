<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\AddLoanRequest;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\PaymentSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LoanController extends APIResponse
{
    public function index()
    {
        $loans = Loan::orderBy('created_at', 'DESC')->with('customer')->paginate(10);

        return $this->success([
            'loans' => $loans
        ]);
    }

    public function add(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'customer_name' => 'required|unique:customers,name',
            'duration' => 'required|numeric|between:0,120',
            'amount' => 'required|numeric|between:0,9999999999.99',
            'bankFile' => 'required|mimes:pdf,csv,txt'
        ]);

        if (!$validator->passes())
            return $this->fail($validator->errors(), 'Entered form data is not valid.');

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
            $loan = $customer->loans()->save(new Loan([
                'amount' => $request->amount,
                'duration' => $request->duration,
                'bank_file' => $randomName,
                'created_by' => $request->user->id
            ]));

            $monthlyAmount = number_format((float) ($request->amount / $request->duration), 2, '.', '');

            for ($month = 1; $month <= $request->duration; $month++) {
                $instalment = new PaymentSchedule();
                $instalment->loan_id = $loan->id;
                $instalment->amount = $monthlyAmount;
                $instalment->due_date = Carbon::now()->addMonths($month)->format('Y-m-d');
                $instalment->save();
            }

            DB::commit();

            return $this->success([
                'customer' => $customer
            ], 'The loan has been added successfully.');
        }

        return $this->fail([], 'Failed to add the loan.');
    }

    public function get($id, Request $request)
    {
        $loan = Loan::where('id', $id)->with('customer', 'schedule')->first();
        if ($loan != null) {
            return $this->success([
                'loan' => $loan
            ]);
        } else {
            return $this->fail([], 'Invalid loan id.');
        }
    }
}
