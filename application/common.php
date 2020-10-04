<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use think\JWT;
/*
 * 1.获取token
 *      GET token
 *      POST token
 *      header token
 * 2. 解析 JWT::verify
 *      成功
 *      失败
 */
function checkToken(){
    $get_token=request()->get('token');
    $post_token=request()->post('token');
    $header_token=request()->header('token');
    if($get_token){
        $token=$get_token;
    }else if($post_token){
        $token=$post_token;
    }else if($header_token){
        $token=$header_token;
    }else{
        json([
            'code'=>404,
            'msg'=>"token不能为空"
        ],401)->send();//401代表授权失败
        exit();
    }
    $tokenResult=JWT::verify($token,config("jwtkey"));
    if(!$tokenResult){
        json([
            'code'=>404,
            'msg'=>"token验证失败"
        ],401)->send();//401代表授权失败
        exit();
    }
//    dump($tokenResult);
    request()->id=$tokenResult["id"];
    request()->username=$tokenResult["user"];
}
