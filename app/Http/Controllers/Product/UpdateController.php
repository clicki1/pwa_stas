<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Color;
use App\Models\Product;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $product->update($data);

        return view('admin.product.show', compact('product'));
    }
}
