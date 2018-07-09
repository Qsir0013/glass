<?php
namespace app\admin\controller;

use app\admin\model\Cate as C;

class Cate extends Base
{
    public function pro()
    {
		$cate = new C();
		$list = $cate->acateList();
		$this->assign('list',$list);
        return $this->fetch();
    }
	
	public function activity()
    {
		$cate = new C();
		$list = $cate->tcateList();
		$this->assign('list',$list);
        return $this->fetch();
    }
	
	public function aadd()
    {
		$cate = new C();
		if(request()->isPost()){
			$_POST['type']=1;
			$cate->check($_POST,'add');
			$this->success('宝贝新分类添加成功','Cate/pro',3);
		}else{
			$nav = $cate->menu();
			$this->assign('homeNav',$nav);
			return $this->fetch();
		}
    }
	
	public function tadd()
    {
		$cate = new C();
        if(request()->isPost()){
			$_POST['type']=2;
			$cate->check($_POST,'tadd');
			$this->success('活动新分类添加成功','Cate/activity',3);
		}else{
			$nav = $cate->menu();
			$this->assign('homeNav',$nav);
			return $this->fetch();
		}
    }
	
	public function enable()
	{
		$cate = new C();
		$data = $cate->enable();
		return 1;
	}
	
	public function disable()
	{
		$cate = new C();
		$data = $cate->disable();
		return 1;
	}
	
	public function del()
	{
		$cate = new C();
		$cate->isDelete();
	}
	
	public function aedit()
	{
		$cate = new C();
		if(request()->isPost()){
			$cate->edit($_POST,'edit');
			$this->success('宝贝分类修改成功','Cate/pro',3);
		}else{
			$data = $cate->oldData();
			$this->assign('info',$data);
			return $this->fetch();
		}
	}
	
	public function tedit()
	{
		$cate = new C();
		if(request()->isPost()){
			$cate->edit($_POST,'tedit');
			$this->success('活动分类修改成功','Cate/activity',3);
		}else{
			$data = $cate->oldData();
			$this->assign('info',$data);
			return $this->fetch();
		}
	}
}
