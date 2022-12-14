<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['amount', 'duration', 'created_by', 'bank_file'];
    public $appends = ['pretty_amount', 'bank_file_link'];
    protected $hidden = ['created_at', 'updated_at'];

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

    public function getBankFileLinkAttribute()
    {
        return route('loan.download', [$this->id]);
    }
}
