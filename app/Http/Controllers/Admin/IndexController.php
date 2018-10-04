<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        $user = Auth::user();

        $data = [];
        $data['code'] = 200;
        $data['msg']  = 'ok';
        $data['info'] = $user;
        return response()->json($data);

    }
}
