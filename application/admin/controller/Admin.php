<?php
namespace app\admin\controller;

use app\admin\model\Admin as U;

class Admin extends Base
{
    public function index()
    {
        $user = new U();
		$list = $user->index();
		$this->assign('list',$list);
        return $this->fetch();
    }
	
	public function del()
	{
		$user = new U();
		$user->isDelete();
	}
	
	public function enable()
	{
		$user = new U();
		$data = $user->enable();
		return 1;
	}
	
	public function disable()
	{
		$user = new U();
		$data = $user->disable();
		return 1;
	}
	
	public function edit()
	{
		$user = new U();
		if(request()->isPost()){
			$user->edit();
			$this->success('管理员修改成功','Admin/index',3);
		}else{
			$info = $user->show();
			$this->assign(['info'=>$info]);
			return $this->fetch();
		}
	}
	
	public function add()
	{
		$user = new U();
		if(request()->isPost()){
			$user->add();
			$this->success('新管理员添加成功','Admin/index',3);
		}else{
			$level = $user->level();
			$this->assign(['level'=>$level]);
			return $this->fetch();
		}
	}
}
