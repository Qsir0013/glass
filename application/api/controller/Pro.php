<?php
namespace app\api\controller;

use think\Request;  
use think\controller\Rest; 

class Pro extends Rest{  

    public function rest(){  
        switch ($this->method){  
            case 'get':     //查询  
                $this->proList($id);  
                break;
        }
    }
	
    public function proList($id){
		switch($id){
			case '0':
				$pro = findMore('pro',[],'id,title,price,banner',['is_delete'=>0,'static'=>1,'is_banner'=>0],'create_time desc','');
				if($pro){
					foreach($pro as $k=>$v){
						$img = findone('images',array(),'src',array('id'=>$v['banner']))['src'];
						$v['img'] = $img;
						unset($v['banner']);
						$proList[] = $v;
					}
					$data['res'] = $proList;
					$data['code'] = 200;
					$data['msg'] = '请求成功';
					return json_encode($data);
				}else{
					$data['res'] = NULL;
					$data['code'] = 404;
					$data['msg'] = '未找到资源';
					return json_encode($data);
				}
				break;
		}
		
		$pro = findMore('pro',[],'id,title,price,banner',['is_delete'=>0,'static'=>1,'cate_id'=>$id,'is_banner'=>0],'create_time desc','');
		if($pro){
			foreach($pro as $k=>$v){
				$img = findone('images',array(),'src',array('id'=>$v['banner']))['src'];
				$v['img'] = $img;
				unset($v['banner']);
				$proList[] = $v;
			}
			$data['res'] = $proList;
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