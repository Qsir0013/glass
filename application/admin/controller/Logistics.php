<?php
namespace app\admin\controller;

use app\admin\model\Logistics as S;

class Logistics extends Base
{
    public function index()
    {
		$sys = new S;
		$data = $sys->index();
		$this -> assign('list',$data);
		return $this->fetch();
    }
	
	public function edit()
	{
		$sys = new S;
		if(request()->isPost()){
			
			$sys->edit();
			$this->success('单号添加成功！','Logistics/index');
		}else{
			$info = $sys->show();
			$this -> assign('info',$info);
			return $this->fetch();
		}
	}
	
	public function search()
	{
		$sys = new S;
		$data = $sys->search();
		$this -> assign('list',$data);
		return $this->fetch('logistics/index');
	}
}
