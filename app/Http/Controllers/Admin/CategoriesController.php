<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * 分类列表
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Category $category){
        $categories = $category
            ->orderBy('created_at', 'desc')
            ->get();
        $data['code'] = 200;
        $data['msg']  = 'ok';
        $data['list'] = $categories;
        return response()->json($data);
    }

    /**
     * 新增用户分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        $this->validate($request, [
            'name'       =>       'required|max:10'
        ]);
        $category = Category::create([
            'pid'    =>    ($request->pid) ? $request->pid : 0,
            'name'   =>    $request->name,
        ]);

        $data = [];
        if($category){
            $data['code'] = 200;
            $data['msg']  = 'ok';
            $data['info'] = [];
        }else{
            $data['code'] = '400';
            $data['msg']  = 'fail';
            $data['info'] = [];
        }
        return response()->json($data);
    }
}
