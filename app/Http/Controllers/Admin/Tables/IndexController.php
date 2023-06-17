<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Service;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {

        $arrs_filter = Service::array_excel();
        $prod_data = Service::array_product();
//        dump($prod_data);
//        dd($data);


      //  dd($arrs_filter);

        // dd($product);

        return view('admin.table.index', compact('arrs_filter', "prod_data"));
    }
}
