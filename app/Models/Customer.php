<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $appends = ['total_due'];
    protected $hidden = ['created_at', 'updated_at'];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'customer_id');
    }

    public function getTotalDueAttribute()
    {
        $due = 0;
        foreach ($this->loans as $loan) {
            $due = +$loan->amount;
        }
        return number_format($due, 2);
    }
}
