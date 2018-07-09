<?php
namespace app\admin\controller;

use app\admin\model\Shop as S;

class Shop extends Base
{
    public function index()
    {
		$sys = new S;
		if(request()->isPost()){
			$sys->edit();
			$this->success('商铺信息修改成功！','Shop/index');
		}else{
			$data = $sys->index();
			$this -> assign('info',$data);
			return $this->fetch();
		}
    }
}
