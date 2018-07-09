<?php
namespace app\admin\model;
use think\config;

class Shop extends Base
{
    public function index()
    {
		$data = config('info');
		$data['oldlogo'] = $data['logo'];
		$data['logo'] = findone('images',array(),'src',array('id'=>$data['logo']))['src'];
		return $data;
    }
	
	public function edit()
	{
		$_POST['logo'] = $this->up('logo',204800,'png');
		$str='<?php
	return[
	'.
		"'title'".' => '."'".$_POST['title']."'".','.
		"'des'".'   => '."'".$_POST['des']."'".','.
		"'logo'".'  => '."'".$_POST['logo']."'".','.
	'
	]'.';';
		$data = file_put_contents(APP_PATH . DS . 'extra' . DS . 'info.php',$str);
		if($data===0){
			msgback('修改异常！');
		}
	}
}