<?php

namespace App\Http\Controllers\Api;


use App\Models\Api\Webvolume;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;


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


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addView(Request $request){
        $nowDay = Carbon::today()->timestamp;

        $ips =  Redis::smembers($nowDay.'ips');
        if(!empty($ips)){
            if(!Redis::sisMember($nowDay.'ips', $request->getClientIp())){
                Redis::sadd($nowDay.'ips', $request->getClientIp());
                $this->addData($nowDay);
            }
        }else{
            Redis::sadd($nowDay.'ips', $request->getClientIp());
            Redis::expire($nowDay.'ips', 86400);
            $this->addData($nowDay);
        }
        return response()->json(['code' => 200, 'msg' => 'ok']);
    }

    /**
     * @param $timestamp
     */
    public function addData($timestamp){
        $data = Webvolume::where('view_at', $timestamp)->first();
        if(!empty($data->id)){
            Webvolume::where('id', $data->id)->increment('view_num');
        }else{
            Webvolume::create([
                'view_at'       =>      $timestamp,
                'view_num'      =>      1
            ]);
        }

    }

}
