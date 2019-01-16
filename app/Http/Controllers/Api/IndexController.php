<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Index;
use App\Models\Api\Webvolume;
use App\Models\Article;
use Carbon\Carbon;
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
    public function articles(Article $article){

        $articles = $article->paginate(8);
        $data['code'] = 200;
        $data['msg']  = 'ok';
        $data['list'] = $articles;
        return response()->json($articles);
    }


    public function addView(Request $request){
        $redis = New \Redis();
        $nowDay = Carbon::today()->timestamp;
        $where  = [
            'view_at'  =>  $nowDay
        ];
        $data = Webvolume::where('view_at', $nowDay)->find();
        dd($data.' '.$nowDay.' '.$request->getClientIp());
        $ips = $redis->sMembers($nowDay.'ips');
        if(!empty($ips)){
            if(!$redis->sIsMember($nowDay.'ips', $request->getClientIp())){
                $redis->sAdd($nowDay.'ips', $request->getClientIp());

            }
        }else{
            $redis->sAdd($nowDay.'ips', $request->getClientIp());
        }



    }

}
