<?php
namespace app\admin\model;

class Cate extends Base
{
    public function check($data,$scene)
    {
		$this->addCheck('Cate','cate',$data,$scene);
		 
    }
	
	public function acateList(){
		$data = $this->listData('cate',array(),'id,cate_name,static',array('type'=>1,'is_delete'=>0));
        return $data;
	}
	
	public function tcateList(){
		$data = $this->listData('cate',array(),'id,cate_name,static',array('type'=>2,'is_delete'=>0));
        return $data;
	}

	public function disable()
	{
		$this->setDisable('cate');
	}
	
	public function enable()
	{
		$this->setEnable('cate');
	}
	
	public function isDelete()
	{
		$this->setIsDelete('cate');
	}
	
	public function edit($data,$scene)
	{
		$this->editData('cate',$data,'Cate',$scene);
	}
	
	public function oldData()
	{
		$data = $this->showData('cate',array(),'cate_name','');
		return $data;
	}
}
