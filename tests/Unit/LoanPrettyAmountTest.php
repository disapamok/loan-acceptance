<?php

namespace Tests\Unit;

use App\Models\Loan;
use PHPUnit\Framework\TestCase;

class LoanPrettyAmountTest extends TestCase
{
    public function testPrettyAmountWithRoundNumber()
    {
        $loan = new Loan([
            'amount' => 1000
        ]);
        $this->assertEquals('1,000.00', $loan->pretty_amount);
    }

    public function testPrettyAmountWithFloatingPointAmount()
    {
        $loan = new Loan([
            'amount' => 9687.50
        ]);
        $this->assertEquals('9,687.50', $loan->pretty_amount);
    }
}
