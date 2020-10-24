<?php

namespace  app\common\model;

use think\Model;

class Orders extends Model{
    protected $autoWriteTimestamp = true;

    public function queryTypeOrders($where){
        return $this->where($where)->select();
    }
    //多表查询，联合酒店房间表查询
    public function queryUnionHotel($where,$field=['hotel_item.hname','hotel_item.hcity','hotel_item.harea','orders.oid','orders.hid','orders.room_type','orders.user_number','orders.enter_time','orders.price','orders.status',]){
        return $this->field($field)->join('hotel_item','orders.hid=hotel_item.hid')->where($where)->select();
    }
    //插入订单
    public function insertorder($info){
        return $this->allowField(true)->save($info);
    }
}