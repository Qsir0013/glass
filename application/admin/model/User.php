<?php
namespace app\admin\model;

class User extends Base
{
    public function index()
    {
		$data = $this->listData('user',array(),'id,username,openid,img,sex,create_time,login_time,static',array('is_delete'=>0));
        return $data;
    }
	
	public function disable()
	{
		$this->setDisable('user');
	}
	
	public function enable()
	{
		$this->setEnable('user');
	}
	
	public function isDelete()
	{
		$this->setIsDelete('user');
	}
	
	public function show()
	{
		$data['info'] = $this->showData('user',array(),'username,openid,img,sex,create_time,login_time,static,phone,is_new','');
		return $data;
	}
}
