<?php
namespace app\api\controller;

use think\Request;  
use think\controller\Rest; 

class Proinfo extends Rest{  

    public function rest(){  
        switch ($this->method){  
            case 'get':     //查询  
                $this->info($id);  
                break;
        }
    }
	
    public function info($id){
		$datas = findone('pro',array(),'id,title,price,img,content,is_new',['is_delete'=>0,'static'=>1,'id'=>$id]);
		if($datas){
			$img = json_decode($datas['img']);
			if($img){
				foreach($img as $k=>$v){
					$img = findone('images',array(),'src',array('id'=>$v))['src'];
					$all[] = $img;
				}
				$datas['img'] = $all;
			}else{
				$datas['img'] = '';
			}
			$data['res'] = $datas;
			$data['code'] = 200;
			$data['msg'] = '请求成功';
			return json_encode($data);
		}else{
			$data['res'] = NULL;
			$data['code'] = 404;
			$data['msg'] = '未找到资源';
			return json_encode($data);
		}
    }
	
	public function erro()
	{
		$data['code'] = 202;
		$data['msg'] = '参数值为空';
		return json_encode($data);
	}
}