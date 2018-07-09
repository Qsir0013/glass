<?php
namespace app\admin\controller;

use app\admin\model\Refund as S;

class Refund extends Base
{
    public function index()
    {
		$sys = new S;
		$data = $sys->index();
		$this -> assign('list',$data);
		return $this->fetch();
    }
	
	public function show()
	{
		$sys = new S;
		$info = $sys->show();
		$this -> assign('info',$info);
		return $this->fetch();
	}
	
	public function enable()
	{
		$sys = new S();
		$data = $sys->enable();
		return 1;
	}
	
	public function search()
	{
		$sys = new S;
		$data = $sys->search();
		$this -> assign('list',$data);
		return $this->fetch('refund/index');
	}
}
