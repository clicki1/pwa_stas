<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Service;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {

        $prod_data = Service::array_product();
    //    dd($prod_data);
//        $first = Product::first();
//        $first_m = $first->created_at->month;
//        $first_y = $first->created_at->year;
//
   //     $lst = Product::latest()->first();
//        $latest_m = $lst->created_at->month;
//        $latest_y = $lst->created_at->year;
//        $y_res = [];
//        $m_res = [];
//        $k = 0;
//        for($x = 2020; $x <= $latest_y; $x++){
//        array_push($y_res, $x);
//        }
//        foreach ($y_res as $year){
//          //  dd($year);
//            if($year < 2021) continue;
//            for($i = 0; $i <= 12 ;$i++){
//                if($year == $latest_y && $i > $latest_m) break;
//
//                if ($year == $first_y && $i < $first_m) {
//                   // dump($i);
//                    continue;
//                }else{
//                    $m_res[$k] = $year.'-'.$i;
//                }
//                $k++;
//            }
//        }
//       $now_data = $latest_y.'-'.$latest_m;
       // dd($now_data);
       // $lst = $prod_data('lst');
       // $m_res[] = $prod_data('m_res');
       // $now_data = $prod_data('now_data');

        $products = Product::orderBy('id', 'DESC')->whereMonth('created_at', $prod_data['latest_m'])->whereYear('created_at', $prod_data['latest_y'])->get();
        return view('admin.product.index', compact('products', 'prod_data'));
//        return view('admin.product.index', compact('products', 'lst', 'm_res', 'now_data'));
    }
}
