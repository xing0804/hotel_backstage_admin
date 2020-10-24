<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Orders extends Controller{
    public $code;
    public $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->code=config('code');
        $this->model=model('Orders');
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data=$this->request->get();
        checkUserToken();
        $uid=$this->request->uid;
        $where=[];
        $where['uid']=$uid;
        if(isset($data['type']) && !empty($data['type'] && !$data['type']==0)){
            $where['status']=$data['type'];
        }
//        $result=$this->model->queryTypeOrders($where);
        $result=$this->model->queryUnionHotel($where);
        if($result){
            return json([
               'code'=>$this->code['success'],
                'msg'=>'订单查询成功',
                'data'=>$result
            ]);
        }else{
            return json([
                'code'=>$this->code['success'],
                'msg'=>'暂无订单信息',
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
        checkUserToken();
        $uid=$this->request->uid;
        $info=$this->request->post();
        $info['uid']=$uid;
        $result=$this->model->insertorder($info);
        if($result){
            return json([
                'code'=>$this->code['success'],
                'msg'=>'订单提交成功',
            ]);
        }else{
            return json([
                'code'=>$this->code['fail'],
                'msg'=>'订单插入失败',
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