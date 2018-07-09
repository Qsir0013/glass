<?php
namespace app\admin\controller;

use app\admin\model\User as U;

class User extends Base
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
	
	public function show()
	{
		$user = new U();
		$data = $user->show();
		$this->assign(['info'=>$data['info']]);
        return $this->fetch();
	}
}
