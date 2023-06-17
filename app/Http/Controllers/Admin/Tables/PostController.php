<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ShowRequest;
use App\Models\Product;
use App\Services\Service;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ShowRequest $request)
    {
        $data = $request->validated();
       //  dd($data);
        $res_data = explode("-",   $data['data']);
        $arrs_filter = Service::array_excel($res_data);
        $prod_data = Service::array_product($res_data);
//        dump($prod_data);
//        dd($data);


      //  dd($arrs_filter);

        // dd($product);

        return view('admin.table.index', compact('arrs_filter', "prod_data"));
    }
}
