<?php

namespace App\Http\Controllers\Admin\Excel;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Table\TableRequest;
use App\Models\Product;
use App\Services\Service;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TablesController extends Controller
{
    public function export(TableRequest $request)
    {
        $data = $request->validated();

       //  dd(now()->toDateTimeString());
        $res_data = explode("-",   $data['data']);
        $arrs_filter = Service::array_excel($res_data);
       // dd($arrs_filter);
        $export = new ProductExport($arrs_filter);

        return Excel::download($export, $data['data'].'---'.time().'.xlsx');
    }
}
