<?php
namespace app\api\controller;

use think\Request;  
use think\controller\Rest; 

class Address extends Rest{  

    public function rest()
	{  
        switch ($this->method){  
            case 'get':     //查询  
                $this->addressList($id);  
                break;  
            case 'post':    //新增  
                $this->add();  
                break;  
            case 'delete':  //删除  
                $this->delete($id);  
                break;
			case 'put':  //修改  
                $this->update($id);  
                break;
        }  
    }
	
    public function addressList($id)
	{  
		$datas = findMore('address',[],'id,type,address',['user_id'=>$id,'is_delete'=>0],'id desc','');
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
	
	 public function add()
	 {  
		$res = checkParameter($_POST);
		$Result = array_diff($res,$_POST);
		if(empty($Result)){
			$address = findone('address',[],'',['address'=>$res['address']]);
			if($address){
				$data['code'] = 202;
				$data['msg'] = '请求成功,数据已存在';
			}else{
				addData('address',$_POST);
				$data['code'] = 200;
				$data['msg'] = '请求成功';
				return json_encode($data);
			}
		}else{
			return json_encode($Result);
		}
    }
	
	public function delete($id)
	{  
		$datas = edit('address',['id'=>$id],['is_delete'=>1]);
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
	
	public function update($id)
	{
		$res = json_decode($id,true);
		$datas = edit('address',['id'=>$res['id']],['address'=>$res['address']]);
		if($datas){
			$data['code'] = 200;
			$data['msg'] = '请求成功';
		}else{
			$data['code'] = 202;
			$data['msg'] = '请求失败';
		}
		echo json_encode($data);
	}

}