<?php
namespace app\admin\controller;

use app\admin\model\Level as U;

class Level extends Base
{
    public function index()
    {
        $user = new U();
		$list = $user->index();
		$this->assign('list',$list);
        return $this->fetch();
    }
	
	public function add()
    {
		$user = new U();
		if(request()->isPost()){
			$user->add();
			$this->success('新权限类型添加成功','Level/index',3);
		}else{
			$menu = $user->menu();
			$this->assign(['menu'=>$menu]);
			return $this->fetch();
		}
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
			$this->success('权限修改成功','Level/index',3);
		}else{
			$data = $user->show();
			$menu = $user->menu();
			$this->assign(['info'=>$data['info'],'menu'=>$menu]);
			return $this->fetch(); 
		}
	}
}
