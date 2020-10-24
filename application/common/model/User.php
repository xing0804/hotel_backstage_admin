<?php

namespace  app\common\model;

use think\Model;

class User extends Model{
    protected $autoWriteTimestamp = true;
    //判断用户是否已经被注册
    public function isRegister($phone){
        return $this->where('phone',$phone)->select();
    }
    //添加用户
    public function add($data){
        return $this->allowField(true)->save($data);
    }
    //查询一条用户数据
    public function queryOne($where,$field=['uid','nickname','phone','collection']){
        return $this->field($field)->where($where)->find();
    }
    //更新收藏
    public function updateCollection($uid,$update){
        return $this->where('uid',$uid)->update($update);
    }
}