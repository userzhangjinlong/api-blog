<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * //用户注册路由界面(前台人员使用后台并不需要 后台执行添加管理人员)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        $this->validate($request, [
            'name'       =>       'required|max:20',
            'email'       =>      'required|email|unique:users|max:255',
            'password'   =>       'required|min:6'
        ]);

        $user = User::created([
            'name'       =>        $request->name,
            'email'      =>        $request->email,
            'password'   =>        $request->bcrypt($request->password),
            'api_token'  =>        str_random(60),
        ]);

        $data = [];
        if($user){
            $data['code'] = 200;
            $data['msg']  = 'ok';
            $data['info'] = [];
        }else{
            $data['code'] = '400';
            $data['msg']  = 'fail';
            $data['info'] = [];
        }
        return response()->json($data);
//        return $data;

    }

    /**
     * 登录返回
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        $post = $this->validate($request, [
            'email'      =>       'required|email|max:255',
            'password'   =>       'required|min:6'
        ]);
/*//这里csrf验证导致分离接口请求报错  后台登录不需要这个
        if (!$token = Auth::attempt($post)) {
            throw new AuthorizationException('Invalid posts.');
        }*/
        if(Auth::attempt($post)){
            //登录成功返回
            $data['code'] = 200;
            $data['info'] = Auth::user();
            $data['msg']  = 'ok';
        }else{
            //登录失败
            $data['code'] = 400;
            $data['info'] = [];
            $data['msg']  = 'fail';
        }

        return response()->json($data);
    }

    public function creates(){
        die('121212');
    }
}
