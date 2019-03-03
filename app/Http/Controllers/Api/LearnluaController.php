<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class LearnluaController extends Controller
{
    public function learn(){
        //通過lua腳本設置簡單的值
//        $lua = <<<EOF
//        return {KEYS[1],KEYS[2],ARGV[1],ARGV[2]}
//EOF;
//        $ret = Redis::eval($lua, 2, 'key1', 'key2', 'first', 'second');
//        dd($ret);
        $lua = <<<EOF
        local kws = {}
        local lrkws = {}
            local nkws = {}
            local kw_ids = {}
            local lr_ids = {}
            local n_ids = {}

            for kw in string.gmatch(KEYS[1], "[^|]+") do
                table.insert(kws, "kw:"..kw)
            end
            for kw in string.gmatch(KEYS[2], "[^|]+") do
                table.insert(lrkws, "lrkw:"..kw)
            end
            for kw in string.gmatch(KEYS[3], "[^|]+") do
                table.insert(nkws, "nkw:"..kw)
            end

            if #kws > 0 then
                kw_ids = redis.call('sinter', unpack(kws))
            end
            if #lrkws > 0 then
                lr_ids = redis.call('sinter', unpack(lrkws))
            end
            if #nkws > 0 then
                n_ids = redis.call('sinter', unpack(nkws))
            end
            local cache_key = ARGV[1]

            for _, v in ipairs(kw_ids) do
                redis.call('sadd', cache_key, v)
            end
            for _, v in ipairs(lr_ids) do
                redis.call('sadd', cache_key, v)
            end
            for _, v in ipairs(n_ids) do
                redis.call('sadd', cache_key, v)
            end
            redis.call('expire', cache_key, 600)
            return redis.call('scard', cache_key)
EOF;
//        $ret = Redis::eval($lua, 3,"你好|谢谢", "", "hello", "cache_key");
        $ret = Redis::eval($lua, ["你好|谢谢", "", "hello", "cache_key"], 2);
        dd($ret);
    }

    public function learnget(Request $request){
        dd($request->json());
    }

    public function learnpost(Request $request){
        dd($request->json());
    }

}
