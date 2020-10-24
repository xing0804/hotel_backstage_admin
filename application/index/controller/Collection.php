<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Collection extends Controller{
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
        checkUserToken();
        $uid=$this->request->uid;
        $usermodel=model('User');
        $userresult=$usermodel->queryOne(['uid'=>$uid]);
        if($userresult){
            $collection=$userresult['collection'];
            if($collection){
                $hotelmodel=model("HotelItem");
                $result=$hotelmodel->queryHotel($collection);
                if($result){
                    return json([
                        'code'=>$this->code['success'],
                        'msg'=>'数据查询成功',
                        'data'=>$result
                    ]);
                }else{
                    return json([
                        'code'=>$this->code['fail'],
                        'msg'=>'数据查询失败',
                    ]);
                }
            }
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
        checkUserToken();
        $uid=$this->request->uid;
        $hotelmodel=model("User");
        $result=$hotelmodel->updateCollection($uid,['collection'=>$data['collection']]);
        if($result){
            return json([
                'code'=>$this->code['success'],
                'msg'=>'数据更新成功'
            ]);
        }else{
            return json([
                'code'=>$this->code['fail'],
                'msg'=>'数据更新失败'
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