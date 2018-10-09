<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{

    public function index(Article $article){

    }


    public function create(Request $request){
        $this->validate($request, [
            'title'       =>      'required|max:20',
            'cat_id'     =>      'required|int|min:1',
            'content'     =>      'required|string'
        ]);
//        var_dump($request->all());die;
        $article = Article::create(
            $request->all()
        );
        //这儿是添加的另一中方式
        /*$article = Article::create([
            'title'          =>         $request->title,
            'cat_id'         =>         $request->cat_id,
            'img_url'        =>         $request->img_url,
            'description'    =>         $request->description,
            'content'        =>         $request->content,
        ]);*/
        $data = [];
        if($article){
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
