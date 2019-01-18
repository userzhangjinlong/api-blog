<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $list = Category::all(['id','name']);
        return response()->json(['code' => 200, 'msg' => 'ok', 'data' =>$list]);
    }
}
