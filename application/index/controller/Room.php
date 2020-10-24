<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Room extends Controller{
    public $code;
    public $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->code=config('code');
        $this->model=model('HotelRoom');
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data=$this->request->get();
        $result=$this->model->queryRoom($data['hid']);
        if($result){
            return json([
                'code'=>$this->code['success'],
                'msg'=>'数据获取成功',
                'data'=>$result
            ]);
        }else{
            return json([
                'code'=>$this->code['success'],
                'msg'=>'暂无房间信息',
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


    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $result=$this->model->queryOne($id);
        if($result){
            return json([
                'code'=>$this->code['success'],
                'msg'=>'数据获取成功',
                'data'=>$result
            ]);
        }else{
            return json([
                'code'=>$this->code['success'],
                'msg'=>'暂无该房间信息',
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