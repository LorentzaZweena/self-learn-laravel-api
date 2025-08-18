<?php

namespace App\Filters\V1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoicesFilter extends ApiFilter
{
    protected $safeParms = [
        // Daftar parameter yang diizinkan untuk filter
        'customerId' => ['eq'],
        'amount' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'status' => ['eq', 'ne'], // 'ne' untuk not equal
        'billedDate' => ['eq', 'gt', 'lt', 'gte', 'lte'], 
        'paidDate' => ['eq', 'gt', 'lt', 'gte', 'lte']
    ];

    protected $columnMap = [
        // Pemetaan nama kolom ke nama yang digunakan dalam filter
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date'
    ];

    protected $operatorMap = [
        // Pemetaan operator ke operator yang digunakan dalam filter
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!='
    ];

    
}