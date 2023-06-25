<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        Product::create($data);
        $http =  $telegram->sendMessage(360336947, $data);
        $http =  $telegram->sendMessage(25810383, $data);
        return redirect()->route('admin.product.index');
    }
}
