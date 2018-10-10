<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{

    /**
     * 文章列表
     *
     * @param Article $article
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Article $article, Request $request){
        // 关键字过滤
        if($keyword = $request->keyword ?? ''){
            $article = $article->where('title', 'like', "%{$keyword}%");
        }



        if($request->created_at){
            if($request->created_at == 'desc'){
                $article = $article->orderBy('created_at', 'desc');
            }else{
                $article = $article->orderBy('created_at', 'asc');
            }
        }
        $articles = $article->paginate(20);


        // 修正页码
        /*if( $articles->count() < 1 && $articles->lastPage() > 1 ){
            return redirect($articles->url($articles->lastPage()));
        }*/

        $data['code'] = 200;
        $data['msg']  = 'ok';
        $data['list'] = $articles;
        return response()->json($data);
    }


    /**
     * 新增文章
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
