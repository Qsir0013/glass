<?php
namespace app\api\controller;

use think\Request;  
use think\controller\Rest; 

class Cate extends Rest{  

    public function rest(){  
        switch ($this->method){  
            case 'get':     //查询  
                $this->all();  
                break;
        }
    }
	
    public function all(){  
		$datas = findMore('cate',[],'id,cate_name',['type'=>1,'static'=>1,'is_delete'=>0],'','');
		if($datas){
			$data['res'] = $datas;
			$data['code'] = 200;
			$data['msg'] = '分类请求成功';
		}else{
			$data['res'] = NULL;
			$data['code'] = 202;
			$data['msg'] = '分类请求失败';
		}
		echo json_encode($data);
    }
}