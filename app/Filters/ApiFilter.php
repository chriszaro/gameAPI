<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
//    protected $safeParms = [];
//
//    protected $columnMap = [];
//
//    protected $operatorMap = [];

    public function transform(Request $request)
    {
        $column = 'genre';

        $query = $request->query($column);

        // if not, continues to the next param
        if (!isset($query)) {
            return [];
        }

        return [[$column, '=', $query]];
    }

    // scalable solution for more operators
//    public function transform(Request  $request){
//        $eloQuery = [];
//
//        // example: take 'genre' for safeParms and save its operators
//        foreach ($this->safeParms as $parm => $operators){
//            //retrieve from request's parameters, the param that is == to parm
//            $query = $request->query($parm);
//
//            // if not, continues to the next param
//            if (!isset($query)){
//                continue;
//            }
//
//            // set column, if camelcase to underscore
//            $column = $this->columnMap[$parm] ?? $parm;
//
//            // for every operator of param
//            foreach ($operators as $operator){
//                // if genre['eq'] has != null
//                if (isset($query[$operator])){
//                    //take ['genre', '=', value from query]
//                    $eloQuery[] = [$column, $this->operatorMap[$operator],  $query[$operator]];
//                }
//            }
//        }
//        return $eloQuery;
//    }

}
