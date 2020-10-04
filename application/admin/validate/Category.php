<?php


namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
    protected $rule=[
        'cid'=>'require|number',
        'cname'=>'require|chsAlphaNum',
        'cdesc'=>'require|chsAlphaNum',
    ];
    protected $message=[
        'cid.require'=>"分类id必填",
        'cid.number'=>"分类id必须是数字",
        'cname.require'=>"分类名称必填",
        'cname.chsAlphaNum'=>"分类名称必须是汉字字母数字",
        'cdesc.require'=>"分类描述必填",
        'cdesc.chsAlphaNum'=>"分类描述必须是汉字字母数字",
    ];
    protected $scene=[
        'add'=>'cname,cdesc',
        'read'=>'cid',
    ];
}