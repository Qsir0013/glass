<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Base as B;

class Base extends Controller
{
    public function _initialize()
	{
		$info = config('info');
		$base = new B();
		if(session('Yj')===NULL){
			$this->success('您还未登录！','Login/index');
		}
		$check = $base->checkLevel();
		if($check){
			$this->success('您没有此权限','Index/index');
		}
		$nav = $base->menu();
		$this->assign(['nav'=>$nav,'webInfo'=>$info]);
	}
}
