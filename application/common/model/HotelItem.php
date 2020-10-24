<?php

namespace  app\common\model;

use think\Model;

class HotelItem extends Model{

    protected $table = 'hotel_item';

    //查询一条用户数据
    public function queryHotel($where,$field=['hid','hname','hprice','haddress','hlabel','himgurl']){
        return $this->field($field)->where('hid','in',$where)->select();
    }

}