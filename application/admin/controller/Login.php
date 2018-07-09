<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Login as L;

class Login extends Controller
{
    public function index()
    {
		if(request()->isPost()){
			$login = new L();
			$admin = $login->index($_POST);
			if($admin){
				$this->success('登陆成功','Index/index');
			}
		}else{
			return $this->fetch();
		}
        
    }
	
	public function singOut()
	{
		$Qsir = session('Yj',NULL);
		if($Qsir===NULL){
			$this->success('退出成功','Login/index');
		}else{
			msg('退出错误！');
		}
	}
}
