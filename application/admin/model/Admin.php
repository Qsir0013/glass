<?php
namespace app\admin\model;

class Admin extends Base
{
    public function index()
    {
		$join = [
			['level l','a.levelid = l.id']
		];
		$data = $this->listData('admin',$join,'a.id,username,level_name,a.create_time,login_time,a.static,a.levelid,a.is_delete',array('a.is_delete'=>0));
		
        return $data;
    }
	
	public function disable()
	{
		$this->setDisable('admin');
	}
	
	public function enable()
	{
		$this->setEnable('admin');
	}
	
	public function isDelete()
	{
		$this->setIsDelete('admin');
	}
	
	public function show()
	{
		$data = $this->showData('admin',array(),'username,levelid,phone',array('is_delete'=>0));
		return $data;
	}
	
	public function level()
	{
		$data = findMore('level',array(),'id,level_name',array('is_delete'=>0),'id');
		return $data;
	}
	
	public function add()
	{
		$_POST['passwd'] = md5($_POST['passwd']);
		$this->addCheck('Admin','admin',$_POST,'');
	}
	
	public function edit()
	{
		$this->editData('admin',$_POST,'Admin','edit');
	}
}
