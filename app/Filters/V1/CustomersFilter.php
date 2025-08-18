<?php

namespace App\Filters\V1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomersFilter extends ApiFilter
{
    protected $safeParms = [
        // Daftar parameter yang diizinkan untuk filter
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'], 
        'address' => ['eq'], 
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        // Pemetaan nama kolom ke nama yang digunakan dalam filter
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        // Pemetaan operator ke operator yang digunakan dalam filter
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>='
    ];
}