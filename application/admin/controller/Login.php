<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\JWT;

/*
 * 1. 验证权限
 * 2. 验证请求方式
 * 3. 接收前台发送的数据
 * 4. 对前台的数据进行验证
 * 5. 处理业务逻辑
 */
class Login extends Controller
{
    public function check(){
        $method=$this->request->method();//获取请求方式
        if($method!='POST'){
            return json([
               'code'=>404,
               'msg'=>'请求方式错误',
            ]);
        }
        $data=$this->request->post();//接收数据
        $validate = validate('Login');
        $flag=$validate->check($data);
        if(!$flag){
            return json([
                'code'=>404,
                'msg'=>$validate->getError(),
            ]);
        }
        //业务逻辑
        $whereArr=['username'=>$data["username"]];
        $user=Db::table("admin")->where($whereArr)->find();
        if($user){
            $password = md5(crypt($data['password'],config("salt")));
            if($password === $user["password"]){
                $payload=[
                    'id'=>$user["id"],
                    'user'=>$user['username'],
                    'avatar'=>$user['avator'],
                ];
                $token=JWT::getToken($payload,config("jwtkey"));
                return json([
                    'code'=>200,
                    'msg'=>'登录成功',
                    'token'=>$token,
                    'user'=>$payload
                ]);
            }
        }else{
            return json([
                'code'=>404,
                'msg'=>'用户名不存在',
            ]);
        }

    }
}