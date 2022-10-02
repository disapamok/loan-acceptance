<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLoanRequest;
use App\Models\Loan;
use Illuminate\Http\Request;

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
        # code...
    }
}
