<?php
namespace app\api\controller;

use think\Request;  
use think\controller\Rest; 

class Info extends Rest{  

    public function rest(){  
        switch ($this->method){  
            case 'get':     //查询  
                $this->info($id);  
                break;
			case 'post':     //修改 
                $this->userEdit();  
                break;
        }
    }
	
    public function info($id){  
		$datas = findMore('user',[],'username,img,sex,phone',['id'=>$id,'static'=>1,'is_delete'=>0],'','');
		if($datas){
			$data['res'] = $datas;
			$data['code'] = 200;
			$data['msg'] = '请求成功';
		}else{
			$data['res'] = NULL;
			$data['code'] = 404;
			$data['msg'] = '未找到资源';
		}
		echo json_encode($data);
    }
	
	public function userEdit(){  
		$res = checkParameter($_POST);
		$Result = array_diff($res,$_POST);
		if(empty($Result)){
			$user = findone('user',[],'',['id'=>$res['id']]);
			if($user){
				$datas = edit('user',['id'=>$res['id']],$_POST);
				if($datas){
					$data['code'] = 200;
					$data['msg'] = '请求成功';
					return json_encode($data);
				}else{
					$data['code'] = 202;
					$data['msg'] = '请求成功,数据未修改';
					return json_encode($data);
				}
			}else{
				$data['code'] = 404;
				$data['msg'] = '资源未找到';
				return json_encode($data);
			}
		}else{
			return json_encode($Result);
		}
    }
	
	public function erro()
	{
		$data['code'] = 202;
		$data['msg'] = '参数值为空';
		return json_encode($data);
	}
}