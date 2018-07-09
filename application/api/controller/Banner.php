<?php
namespace app\api\controller;

use think\Request;  
use think\controller\Rest; 

class Banner extends Rest{  

    public function rest(){  
        switch ($this->method){  
            case 'get':     //查询  
                $this->bannerPro();  
                break;
        }
    }
	
    public function bannerPro(){  
		$pro = findMore('pro',[],'id,banner',['is_delete'=>0,'static'=>1,'is_banner'=>1],'create_time desc',3);
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
}