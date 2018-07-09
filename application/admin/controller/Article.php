<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Article as A;

class Article extends Base
{
    public function index()
    {
		$article = new A();
		$data = $article->index();
		$this->assign('list',$data);
        return $this->fetch();
    }
	
	public function add()
    {
		$article = new A();
		if(request()->isPost()){
			$article->check();
			$this->success('新文章添加成功','Article/index',2);
		}else{
			$articleCate = $article->acateList();
			$targs = $article->tcateList();
			$homeNav = $article->menu();
			$this->assign(['articleCate'=>$articleCate,'targs'=>$targs,'homeNav'=>$homeNav]);
			return $this->fetch();
		}
    }
	
	public function del()
	{
		$article = new A();
		$article->isDelete();
	}
	
	public function enable()
	{
		$article = new A();
		$data = $article->enable();
		return 1;
	}
	
	public function disable()
	{
		$article = new A();
		$data = $article->disable();
		return 1;
	}
	
	public function show()
	{
		$article = new A();
		$data = $article->show();
		$articleCate = $article->acateList();
		$targs = $article->tcateList();
		$homeNav = $article->menu();
		$this->assign(['articleCate'=>$articleCate,'targs'=>$targs,'homeNav'=>$homeNav,'info'=>$data]);
        return $this->fetch();
	}
	
	public function edit()
	{
		$article = new A();
		if(request()->isPost()){
			$article->edit();
			$this->success('文章修改成功','Article/index',2);
		}else{
			$data = $article->show();
			$articleCate = $article->acateList();
			$targs = $article->tcateList();
			$homeNav = $article->menu();
			$this->assign(['articleCate'=>$articleCate,'targs'=>$targs,'homeNav'=>$homeNav,'info'=>$data]);
			return $this->fetch();
		}
	}
}
