<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();
        $data['nohash_password'] = $data['password'];
        $key = md5($data['nohash_password'] . $data['email']);
        $data['key'] = $key;

        $usr = User::firstOrCreate([
            'email' => $data['email']
        ],$data);

        return redirect()->route('admin.user.index');
    }
}
