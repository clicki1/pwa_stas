<?php

namespace App\Http\Controllers\Product\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Models\Product;
use App\Services\Telegram;

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

        $bot = config('bots.bot');
        $telegram = new Telegram($bot);
        $data['name'] = auth()->user()->name;
        $http =  $telegram->sendMessage(360336947, $data);
        return redirect()->route('index');
    }
}
