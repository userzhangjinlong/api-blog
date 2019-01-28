<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function articles(Request $request){
        $list = Article::where('cat_id', $request->cateId)->get(['id', 'created_at', 'title']);

        foreach($list as $k => $v){
            $list[$k]['create_time'] = date('Y-m-d',  strtotime($v->created_at));
        }

        $cateinfo = Category::where('id', $request->cateId)->first();

        return response()->json(['code' => 200, 'msg' => 'ok', 'data' => $list, 'cateinfo' => $cateinfo]);
    }
}
