<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Index;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{

    /**
     * 文章列表
     *
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Article $article){
        $articles = $article->paginate(20);

        $data['code'] = 200;
        $data['msg']  = 'ok';
        $data['list'] = $articles;
        return response()->json($data);
    }
}
