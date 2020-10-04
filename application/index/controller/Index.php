<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        echo md5(crypt(config("defaltPassword"),config("salt")));
        return json([
            'code'=>200,
            'msg'=>'success',
        ]);
    }
    public function lists(){
        $student=Db::table("student")->select();
        $data=['name'=>'张三','age'=>'21'];
        $skill=["html","css","js","php"];
        $this->assign("person",$data);
        $this->assign("skill",$skill);
        $this->assign("student",$student);
        return $this->fetch();
    }
}
