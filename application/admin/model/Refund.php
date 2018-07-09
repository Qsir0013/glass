<?php
namespace app\admin\model;
use think\config;

class Refund extends Base
{
    public function index()
    {
		$join = [
			['user u','a.openid = u.openid']
		];
		$data = $this->listData('refund',$join,'a.id,order_num,total,paid,username,refund,company,odd,a.static,a.create_time',array());
		return $data;
    }
	
	public function show()
	{
		$join = [
			['user u','a.openid = u.openid']
		];
		$data = $this->oneData('refund',$join,'order_num,username,total,paid,refund,reason,company,odd,a.static,a.create_time',['a.id'=>input('id')]);
		return $data;
	}
	
	public function enable()
	{
		$this->setEnable('refund');
	}
	
	public function search()
	{
		$join = [
			['user u','a.openid = u.openid']
		];
		$data = $this->listData('refund',$join,'a.id,order_num,total,paid,username,refund,company,odd,a.static,a.create_time',array('order_num'=>$_POST['search']));
		return $data;
	}
}