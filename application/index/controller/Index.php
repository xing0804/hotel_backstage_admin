<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    public $code;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->code=config('code');
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data=$this->request->get();
        $htype=$data['htype'];
        if($htype=="全部"){
            $htype='%型%';
        }
        $result=Db::table('hotel_item')->field('hid,hname,hprice,hscore,htype,hprovince,hcity,harea,haddress,himgurl')->where('htype','like',$htype)->select();
        $hotelItem=$result;
        if($hotelItem){
            return json([
                'code'=>$this->code['success'],
                'msg'=>"数据查询成功",
                'data'=>$hotelItem,
            ]);
        }

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data=$this->request->post();
//判断酒店是否已存在
        $hname=$data['hname'];
        $isExist=Db::table('hotel_item')->where('hname',$hname)->count();
        if($isExist){
            return json([
                'code'=>$this->code['fail'],
                'msg'=>"该酒店已经注册过了！"
            ]);
        }
        $result=Db::table('hotel_item')->insert($data);
        if($result){
            return json([
                'code'=>$this->code['success'],
                'msg'=>"数据插入成功！"
            ]);
        }else{
            return json([
                'code'=>$this->code['fail'],
                'msg'=>"数据插入成功！"
            ]);
        }

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //获取酒店信息
        $hotelInfo=Db::table("hotel_item")->where("hid",$id)->find();
        if($hotelInfo){
            return json([
                'code'=>200,
                'msg'=>"数据查询成功",
                'hotelInfo'=>$hotelInfo,
            ]);
        }


    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
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
