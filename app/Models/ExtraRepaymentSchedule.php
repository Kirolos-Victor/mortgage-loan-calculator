<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraRepaymentSchedule extends Model
{
    use HasFactory;

    protected $table = 'extra_repayment_schedule';
    protected $fillable = [
            'month_number',
            'starting_balance',
            'monthly_payment',
            'principal_component',
            'interest_component',
            'ending_balance',
            'user_id',
            'extra_repayment',
            'remaining_loan_term',
    ];
    public $timestamps = true;
}
