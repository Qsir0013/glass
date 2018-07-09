<?php
namespace app\admin\model;

class Addresslink extends Base
{
	
    public function index(){
		$data = $this->listData('link',array(),'id,url_name,url,create_time,static',array('is_delete'=>0));
        return $data;
	}
	
	public function check()
    {
        $this->addCheck('Addresslink','link',$_POST,'add');
    }
	
	public function disable()
	{
		$this->setDisable('link');
	}
	
	public function enable()
	{
		$this->setEnable('link');
	}
	
	public function isDelete()
	{
		$this->setIsDelete('link');
	}
	
	public function show()
	{
		$data = $this->showData('link',array(),'url_name,url,admin,email,describe,create_time','');
		return $data;
	}
	
	public function edit($data)
	{
		$this->editData('link',$data,'Addresslink','edit');
	}
	
	public function oldData()
	{
		$data = $this->showData('link',array(),'url_name,url,admin,email,describe,create_time','');
		return $data;
	}
}
