<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function query1()
    {
       $res = DB::table('users AS u')
           ->leftJoin('orders AS o', 'u.id', '=', 'o.user_id')
           ->leftJoin('products AS p', 'p.id', '=', 'o.product_id')
           ->select('u.name', 'u.email', 'u.address', DB::raw('SUM(p.price * o.quantity) as total_amount'))
           ->where('o.purchase_date', '<', now()->subDays(30))
           ->groupBy('u.name', 'u.email', 'u.address')
           ->get();
       return  $res;
    }

    public function query2()
    {
        $res = DB::table('products AS p')
            ->leftJoin('orders AS o', 'p.id', '=', 'o.product_id')
            ->select('p.name', DB::raw('SUM(o.quantity) as total_quantity'), DB::raw('AVG(p.rating) as average_rating'))
            ->groupBy('p.name')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();
        return  $res;

    }
}
