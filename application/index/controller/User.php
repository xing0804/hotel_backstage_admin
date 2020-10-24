<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class User extends Controller{
    public $code;
    public $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->code=config('code');
        $this->model=model('User');
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

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
        $data = $this->request->post();
        //验证规则

        $data['password']=secrePassword($data['password']);
        $data['nickname']='上帝'.time();


        //验证用户是否存在
        //从数据库获取所有的用户手机号
        $isReg=$this->model->isRegister($data['phone']);
        if($isReg){
            return json([
                "code"=>$this->code['fail'],
                "msg"=>"该手机号已被注册"
            ]);
        }

        $result = $this->model->add($data);
        if($result){
            return json([
               "code"=>$this->code['success'],
               "msg"=>"注册成功"
            ]);
        }else{
            return json([
                "code"=>$this->code['fail'],
                "msg"=>"注册失败"
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
        checkUserToken();
        $uid=$this->request->uid;
        $result=$this->model->queryOne(['uid'=>$uid],'uid,avatar,nickname,sex,phone');
        if($result){
            $result['sexText']=sexCodeToText($result['sex']);
            return json([
                'code'=>$this->code['success'],
                'msg'=>"数据获取成功",
                'data'=>$result,
            ]);
        }else{
            return json([
                'code'=>$this->code['success'],
                'msg'=>"暂无数据",
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

}