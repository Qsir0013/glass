<?php
namespace app\api\controller;

use think\Request;  
use think\controller\Rest; 

class User extends Rest{  

    public function rest(){		
        switch ($this->method){  
            case 'get':     //查询  
                $this->getOpenid();  
                break;
        }
    }
	
    public function getOpenid(){
		$ip = getip();
		$data = findone('browse',array(),'*',array('date'=>date("Y-m-d"),'ip'=>$ip));
		if($data){
			$data['num'] = $data['num']+1;
			edit('browse',array('id'=>$data['id']),$data);
		}else{
			$data['date'] = date("Y-m-d");
			$data['num'] = 1;
			$data['ip'] = $ip;
			addData('browse',$data);
		}
		$code = $_GET['code'];
		$nick = $_GET['nick'];
		$imgUrl = $_GET['avaurl'];
		$sex = $_GET['sex'];
		$program = config('program');
		$appid = $program['appid'];
		$secret = $program['secret'];
		$url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid .'&secret=' . $secret .'&js_code=' . $code . '&grant_type=authorization_code';  
		$info = file_get_contents($url);
		$json = json_decode($info);
		$arr = get_object_vars($json);
		$openid = $arr['openid'];
		$session_key = $arr['session_key'];
		
		$udata['username'] = $nick.time();
		$udata['openid'] = $openid; 
		$udata['img'] = $imgUrl;
		$udata['sex'] = $sex;
		$user = findone('user',[],'id,is_new,username',['openid'=>$openid]);
		
		if($user){
			edit('user',['openid'=>$openid],['login_time'=>date("Y-m-d H:i:s")]);
			$arr['res'] = $user;
			$arr['code'] = 200;
			$arr['msg'] = '请求成功';
			echo json_encode($arr);
		}else{
			$userId = addId('user',$udata);
			$user = findone('user',[],'id,is_new',['id'=>$userId]);
			$arr['res'] = $user;
			$arr['code'] = 200;
			$arr['msg'] = '请求成功，注册新用户！';
			echo json_encode($arr);
		}
		
	}
}