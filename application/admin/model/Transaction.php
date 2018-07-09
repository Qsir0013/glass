<?php
namespace app\admin\model;
use think\config;

class Transaction extends Base
{
    public function index()
    {
		$join = [
			['order o','a.order_id = o.id']
		];
		$data = $this->listData('transaction',$join,'a.id,a.order_id,o.number as orderNum,a.create_time',array());
		return $data;
    }
	
	public function search()
	{
		$join = [
			['order o','a.order_id = o.id']
		];
		$data = $this->listData('transaction',$join,'a.id,a.order_id,o.number as orderNum,a.create_time',array('o.number'=>$_POST['search']));
		return $data;
	}
}