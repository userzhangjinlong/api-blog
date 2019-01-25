<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function readNum(Request $request){
        Article::where('id', $request->postId)->increment('brow_volume');

        return response()->json(['code' => 200, 'msg' => 'ok']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function details(Request $request){
        $article = Article::find($request->postId);

        return response()->json(['code' => 200, 'msg' => 'ok', 'article' => $article]);
    }
}
