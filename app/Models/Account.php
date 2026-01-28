<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'account_number',
        'principal_amount',
        'interest_rate',
        'term_months',
        'monthly_payment',
        'total_amount',
        'balance',
        'start_date',
        'maturity_date',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'principal_amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'monthly_payment' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'balance' => 'decimal:2',
        'start_date' => 'date',
        'maturity_date' => 'date',
    ];

    /**
     * Get the customer that owns the account.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get all transactions for the account.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function lastPaymentDate()
    {
        return $this->transactions()
            ->where('type', 'payment')
            ->orderBy('transaction_date', 'desc')
            ->first()?->transaction_date;
    }
}