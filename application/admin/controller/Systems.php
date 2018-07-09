<?php
namespace app\admin\controller;

use app\admin\model\Systems as S;

class Systems extends Base
{
    public function index()
    {
		$sys = new S;
		if(request()->isPost()){
			$sys->edit();
			$this->success('小程序配置修改成功！','Systems/index');
		}else{
			$data = $sys->index();
			$this -> assign('info',$data);
			return $this->fetch('systems/program');
		}
    }
	
	public function pay()
    {
		$sys = new S;
		if(request()->isPost()){
			$sys->pedit();
			$this->success('支付配置修改成功！','Systems/pay');
		}else{
			$data = $sys->pay();
			$this -> assign('info',$data);
			return $this->fetch();
		}
    }
}
