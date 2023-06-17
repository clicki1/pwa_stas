<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ShowRequest;
use App\Models\Product;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ShowRequest $request)
    {
        $data = $request->validated();
       // dd($data);
        $res_data = explode("-",   $data['data']);

        $prod_data = Service::array_product( $res_data);
//        $first = Product::first();
//        $first_m = $first->created_at->month;
//        $first_y = $first->created_at->year;
//
//        $lst = Product::latest()->first();
//        $latest_m = $lst->created_at->month;
//        $latest_y = $lst->created_at->year;
//        $y_res = [];
//        $m_res = [];
//        $k = 0;
//        for($x = 2020; $x <= $latest_y; $x++){
//            array_push($y_res, $x);
//        }
//        foreach ($y_res as $year){
//            //  dd($year);
//            if($year < 2021) continue;
//            for($i = 0; $i <= 12 ;$i++){
//                if($year == $latest_y && $i > $latest_m) break;
//
//                if ($year == $first_y && $i < $first_m) {
//                    // dump($i);
//                    continue;
//                }else{
//                    $m_res[$k] = $year.'-'.$i;
//                }
//                $k++;
//            }
//        }
//
//        $now_data = $res_data[0].'-'.$res_data[1];

        $products = Product::orderBy('id', 'DESC')->whereMonth('created_at', $res_data[1])->whereYear('created_at', $res_data[0])->get();

        return view('admin.product.index', compact('products', 'prod_data'));
    }
}
