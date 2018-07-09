<?php
namespace app\admin\model;

use think\Model;

class Login extends Model
{
    public function index($data)
    {
        $admin = findone('admin',array(),'id,username,phone,create_time,levelid,login_time,static',array('username'=>$data['name'],'passwd'=>strtoupper(md5($data['passwd'])),'is_delete'=>0));
		if($admin){
			if($admin['static']===1){
				$date['login_time']=date('Y-m-d H:i:s');
				$date['create_time']=$admin['create_time'];
				edit('admin',array('id'=>$admin['id']),$date);
				$check = isset($data['check'])&&!empty($data['check'])?$data['check']:'';
				if($check=='on'){
					cookie('Yj',$data);
					session('Yj',$admin);
					return $admin;
				}else{
					session('Yj',$admin);
					return $admin;
				}
			}else{
				msgback('该账号已被禁用！');
			}
		}else{
			msgback('信息错误！');
		}
    }
}