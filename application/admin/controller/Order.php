<?php
namespace app\admin\controller;

use app\admin\model\Order as S;

class Order extends Base
{
    public function index()
    {
		$sys = new S;
		if(request()->isPost()){
			$this -> assign('list',$sys -> searchUser());
			return $this->fetch();
		}else{
			$data = $sys->index();
			$this -> assign('list',$data);
			return $this->fetch();
		}
    }
	
	public function edit()
	{
		$sys = new S;
		if(request()->isPost()){
			 $sys->edit();
			 $this->success('价格修改成功！','Order/index');
		}else{
			$info = $sys->show();
			$this -> assign('info',$info);
			return $this->fetch();
		}
	}
	
	public function show()
	{
		$sys = new S;
		$info = $sys->show();
		$this -> assign('info',$info);
		return $this->fetch();
	}
}
