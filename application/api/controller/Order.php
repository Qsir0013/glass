<?php
namespace app\api\controller;

use think\Request;  
use think\controller\Rest; 

class Order extends Rest{  

    public function rest(){  
        switch ($this->method){  
            case 'get':     //查询  
                $this->orderList($id);  
                break;
			case 'post':     //添加  
                $this->add();  
                break;
			case 'delete':     //删除  
                $this->del($id);  
                break;
        }
    }
	
    public function orderList($id){
		$data = json_decode($id,true);
		switch ($data['blei']){
			case 0: //全部
			$datas = findMore('order',[],'id,number,total,num,type,is_delete,create_time,pro',['user_id'=>$data['user_id']],'','');
			break;
			case 1: //代付款
			$datas = findMore('order',[],'id,number,total,num,type,is_delete,create_time,pro',['user_id'=>$data['user_id'],'pay_static'=>0],'','');
			break;
			case 2: //代发货
			$datas = findMore('order',[],'id,number,total,num,type,is_delete,create_time,pro',['user_id'=>$data['user_id'],'logistics_static'=>0],'','');
			break;
			case 3: //待收货
			$datas = findMore('order',[],'id,number,total,num,type,is_delete,create_time,pro',['user_id'=>$data['user_id'],'logistics_static'=>1],'','');
			break;
			case 4: //已完成
			$datas = findMore('order',[],'id,number,total,num,type,is_delete,create_time,pro',['user_id'=>$data['user_id'],'is_delete'=>2],'','');
			break;
			case 5: //退款中
			$datas = findMore('order',[],'id,number,total,num,type,is_delete,create_time,pro',['user_id'=>$data['user_id'],'pay_static'=>0],'','');
			break;
		}
		if($datas){
			foreach($datas as $k=>$v){
				$pro = json_decode($v['pro'],true);
				foreach($pro as $kk=>$vv){
					$pro = findone('pro',[],'id,title,banner',['id'=>$vv['id']]);
					$v['proid'] =  $pro['id'];
					$v['img'] = findone('images',array(),'src',array('id'=>$pro['banner']))['src'];
					$v['title'][$kk] = $pro['title'];
					unset($v['pro']);
				}
				$ordeAll[] = $v;
			}
			$data['res'] = $ordeAll;
			$data['code'] = 200;
			$data['msg'] = '分类请求成功';
		}else{
			$data['res'] = NULL;
			$data['code'] = 404;
			$data['msg'] = '未找到资源';
		}
		echo json_encode($data);
    }
	
	public function add(){  
		$_POST['number'] = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
		$res = checkParameter($_POST);
		$Result = array_diff($res,$_POST);
		if(empty($Result)){
			$newOrder = addData('order',$_POST);
			if($newOrder){
				$data['code'] = 200;
				$data['msg'] = '请求成功';
			}else{
				$data['code'] = 202;
				$data['msg'] = '请求失败';
			}
			return json_encode($data);
		}else{
			return json_encode($Result);
		}
    }
	
	public function del($id)
	{
		$del = isDelete('order',['id'=>$id],['is_delete'=>1]);
		if($del){
			$data['code'] = 200;
			$data['msg'] = '请求成功';
		}else{
			$data['code'] = 202;
			$data['msg'] = '请求失败';
		}
		echo json_encode($data);
	}
}