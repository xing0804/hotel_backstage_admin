<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Lists extends Controller{
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
        $data = $this->request->get();
        //初始化分页信息
        if(isset($data['page']) && !empty($data['page'])){
            $page=$data['page'];
        }else{
            $page=1;
        }
        if(isset($data['limit']) && !empty($data['limit'])){
            $limit=$data['limit'];
        }else{
            $limit=config('paginate.list_rows');
        }
        //初始化搜索信息
        $where=[];
        if(isset($data['hprovince']) && !empty($data['hprovince'])){
            $where['hprovince']=$data['hprovince'];
        }
        if(isset($data['hcity']) && !empty($data['hcity'])){
            $where['hcity']=$data['hcity'];
        }
        if(isset($data['hname']) && !empty($data['hname'])){
            $where['hname']=['like','%'.$data['hname'].'%'];
        }
        //价格排序信息初始化
        if(isset($data['hpriceorder']) && !empty($data['hpriceorder'])){
            $hpriceorder=$data['hpriceorder'];
        }else{
            $hpriceorder="asc";
        }

        if(isset($data['hpositionorder']) && !empty($data['hpositionorder'])){
            if($data['hpositionorder']=="本省"){
                $where['hprovince']="山西省";
                unset($where['hcity']);
            }else if($data['hpositionorder']=="本市"){
                $where['hcity']="太原市";
                unset($where['hprovince']);
            }
        }
        if(isset($data['htypeorder']) && !empty($data['htypeorder'])){
            $where['htype']=$data['htypeorder'];
        }


        $result=Db::table('hotel_item')->field('hid,hname,himgurl,hprice,hscore,hlabel')->where($where)->order("hprice",$hpriceorder)->paginate($limit,false,['page'=>$page]);

        $total=$result->total();
        $items=$result->items();

        if($items && $total){
            return json([
                'code'=>$this->code['success'],
                'msg'=>"数据获取成功",
                'data'=>$items,
                'total'=>$total,
                'info'=>$data,
            ]);
        }else{
            return json([
                'code'=>$this->code['success'],
                'msg'=>"暂无数据",
                'info'=>$data,
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