<?php

namespace  app\common\model;

use think\Model;

class HotelRoom extends Model{

    protected $table = 'hotel_room';

    //查询一个酒店对应的所有房间数据
    public function queryRoom($where,$field=['rid','rname','rtype','rimgurl','rlabel','rshower','ramenities','rmedia','rbanner','rdiscount','rprice']){
        return $this->field($field)->where('hid',$where)->select();
    }
    //查询一条房间数据
    public function queryOne($where,$field=['rid','rname','rtype','rimgurl','rlabel','rshower','ramenities','rmedia','rbanner','rdiscount','rprice']){
        return $this->field($field)->where('rid',$where)->find();
    }

}