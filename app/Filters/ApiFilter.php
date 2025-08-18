<?php

namespace App\Filters;
use Illuminate\Http\Request;

class ApiFilter
{
    protected $safeParms = [];

    protected $columnMap = [];

    protected $operatorMap = [];

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