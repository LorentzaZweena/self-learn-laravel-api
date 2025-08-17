<?php

namespace App\Services\V1;
use Illuminate\Http\Request;

class CustomerQuery
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

    public function transform(Request $request)
    {
        $eloQuery = [];
        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);
            if (!isset($query)) {
                continue; // Jika parameter tidak ada, lewati
            }

            $column = $this->columnMap[$parm] ?? $parm; // Gunakan pemetaan kolom jika ada
            foreach( $operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    } 
}