<?php
namespace app\admin\model;
use think\config;

class Systems extends Base
{
    public function index()
    {
		$data = config('program');
		return $data;
    }
	
	public function edit()
	{
		$str='<?php
	return[
	'.
		"	'appid'".' => '."'".$_POST['appid']."'".',
		'.
		"'secret'".' => '."'".$_POST['secret']."'".',
		'.
	'
	]'.';';
		$data = file_put_contents(APP_PATH . DS . 'extra' . DS . 'program.php',$str);
		if($data===0){
			msgback('修改异常！');
		}
	}
	
	public function pay()
    {
		$data = config('pay');
		return $data;
    }
	
	public function pedit()
	{
		$str='<?php
	return[
	'.
		"	'mch_id'".' => '."'".$_POST['mch_id']."'".',
		'.
		"'key'".' => '."'".$_POST['key']."'".',
		'.
		"'app_id'".' => '."'".$_POST['app_id']."'".',
		'.
		"'cert_path'".' => '."'".$_POST['cert_path']."'".',
		'.
		"'key_path'".' => '."'".$_POST['key_path']."'".',
		'.
		"'notify_url'".' => '."'".$_POST['notify_url']."'".',
		'.
	'
	]'.';';
		$data = file_put_contents(APP_PATH . DS . 'extra' . DS . 'pay.php',$str);
		if($data===0){
			msgback('修改异常！');
		}
	}
}
