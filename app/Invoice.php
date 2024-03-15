<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_id', 'coupon', 'net_total', 'payment_method', 'paid',
    ];
}
