<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * 分类列表（所有）
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
     * 分类列表
     *
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(Category $category, Request $request){
        // 关键字过滤
        if($keyword = $request->keyword ?? ''){
            $category = $category->where('name', 'like', "%{$keyword}%");
        }



        if($request->created_at){
            if($request->created_at == 'desc'){
                $category = $category->orderBy('created_at', 'desc');
            }else{
                $category = $category->orderBy('created_at', 'asc');
            }
        }
        $categories = $category->paginate(20);
        // 修正页码
        /*if( $articles->count() < 1 && $articles->lastPage() > 1 ){
            return redirect($articles->url($articles->lastPage()));
        }*/

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

    /**
     * 编辑分类
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){
        if(Category::where('id','=', $request->id)->update(['name' => $request->name])){
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

    /**
     * 删除分类
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request){
//        $delete = Category::where('id','=',$request->id)->delete();
//        $delete = $category->delete($request->id);
        if(Category::where('id','=',$request->id)->delete()){
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

    /**
     * 批量删除
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request){
        if(Category::whereIn('id', $request->id)->delete()){
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
