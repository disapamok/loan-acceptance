<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['amount', 'duration', 'created_by', 'bank_file'];
    public $appends = ['pretty_amount'];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function getPrettyAmountAttribute()
    {
        return number_format($this->amount, 2);
    }

    public function schedule()
    {
        return $this->hasMany(PaymentSchedule::class, 'loan_id');
    }
}
