<?php
namespace app\api\controller;

use think\Request;  
use think\controller\Rest; 

class Shopcate extends Rest{  

    public function rest(){  
        switch ($this->method){  
            case 'get':     //查询  
                $this->shoppingList($id);  
                break;
			case 'post':     //添加||修改 
                $this->add();  
                break;
        }
    }
	
    public function shoppingList($id){  
		$datas = findone('shopping',[],'id,pro',['user_id'=>$id]);
		if($datas){
			$pro = json_decode($datas['pro'],true);
			foreach($pro as $k=>$v){
				$pro = findone('pro',[],'title,price,banner',['id'=>$v['id']]);
				$img = findone('images',[],'src',['id'=>$pro['banner']]);
				$pros['title'] = $pro['title'];
				$pros['price'] = $pro['price'];
				$pros['img'] = $img['src'];
				$pros['num'] = $v['num'];
				$prolist[] = $pros;
			}
			$data['res'] = $prolist;
			$data['code'] = 200;
			$data['msg'] = '请求成功';
		}else{
			$data['res'] = NULL;
			$data['code'] = 404;
			$data['msg'] = '未找到资源';
		}
		echo json_encode($data);
    }
	
	public function add(){  
		$res = checkParameter($_POST);
		$Result = array_diff($res,$_POST);
		if(empty($Result)){
			$datas = findone('shopping',[],'id',['user_id'=>$res['user_id']]);
			if($datas){
				$shopCate = edit('shopping',['id'=>$datas['id']],$res);
				if($shopCate){
					$data['code'] = 200;
					$data['msg'] = '请求成功';
				}else{
					$data['code'] = 202;
					$data['msg'] = '请求失败';
				}
			}else{
				$newshopping = addData('shopping',$res);
				if($newshopping){
					$data['code'] = 200;
					$data['msg'] = '请求成功';
				}else{
					$data['code'] = 202;
					$data['msg'] = '请求失败';
				}
			}
			return json_encode($data);
		}else{
			return json_encode($Result);
		}
    }
}