<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;
    public function customer()
    {
        //di mana satu Invoice hanya dimiliki oleh satu Customer
        //dan satu Customer dapat memiliki banyak Invoice
        return $this->belongsTo(Customer::class);
    }
}
