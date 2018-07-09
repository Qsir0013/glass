<?php
namespace app\admin\controller;

use app\admin\model\Index as I;

class Index extends Base
{
    public function index()
    {
		$index = new I();
		$data = $index->index();
		$this->assign('tongji',$data);
        return $this->fetch();
    }
	
	public function cinfo()
	{
		$index = new I();
		if(request()->isPost()){
			$index->cinfo();
			$this->success('修改信息成功，请重新登陆！','Login/index');
		}else{
			return $this->fetch();
		}
	}
}
