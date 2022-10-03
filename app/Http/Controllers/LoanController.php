<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLoanRequest;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\PaymentSchedule;
use Carbon\Carbon;
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
        $loans = Loan::orderBy('created_at', 'DESC')->with('customer')->paginate(10);

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
            $loan = $customer->loans()->save(new Loan([
                'amount' => $request->amount,
                'duration' => $request->duration,
                'bank_file' => $randomName,
                'created_by' => auth()->id()
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

    public function downloadFile(Loan $loan, Request $request)
    {
        $fileName = $loan->bank_file;

        if ($fileName != '') {
            $filePath = storage_path('app/public/bank-files/' . $fileName);
            $extension = explode('.', $fileName)[1];
            $downloadFileName = 'LOAN0' . $loan->id . '.' . $extension;

            return response()->download($filePath, $downloadFileName);
        } else {
            abort(404);
        }
    }
}
