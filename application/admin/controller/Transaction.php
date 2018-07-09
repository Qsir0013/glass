<?php
namespace app\admin\controller;

use app\admin\model\Transaction as S;

class Transaction extends Base
{
    public function index()
    {
		$sys = new S;
		$data = $sys->index();
		$this -> assign('list',$data);
		return $this->fetch();
    }
	
	public function search()
	{
		$sys = new S;
		$data = $sys->search();
		$this -> assign('list',$data);
		return $this->fetch('transaction/index');
	}
}
