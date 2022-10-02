<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSchedule extends Model
{
    protected $table = 'payment_schedule';
    public $appends = ['pretty_amount'];

    public function getPrettyAmountAttribute()
    {
        return number_format($this->amount, 2);
    }
}
