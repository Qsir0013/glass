<?php
namespace app\admin\controller;

use app\admin\model\Pro as U;

class Pro extends Base
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
	
	public function enbanner()
	{
		$user = new U();
		$data = $user->enbanner();
		return 1;
	}
	
	public function disbanner()
	{
		$user = new U();
		$data = $user->disbanner();
		return 1;
	}
	
	public function edit()
	{
		$user = new U();
		if(request()->isPost()){
			$user->edit();
			$this->success('该产品修改成功','Pro/index',3);
		}else{
			$info = $user->show();
			$pro = $user->proCate();
			$hd  = $user->hdCate();
			$this->assign(['pro'=>$pro,'hd'=>$hd,'info'=>$info]);
			return $this->fetch();
		}
	}
	
	public function add()
	{
		$user = new U();
		if(request()->isPost()){
			$user->add();
			$this->success('新产品添加成功','Pro/index',3);
		}else{
			$pro = $user->proCate();
			$hd  = $user->hdCate();
			$this->assign(['pro'=>$pro,'hd'=>$hd]);
			return $this->fetch();
		}
	}
}
