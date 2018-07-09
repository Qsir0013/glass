<?php
namespace app\admin\model;
use think\config;

class Logistics extends Base
{
    public function index()
    {
		$join = [
			['order o','a.order_id = o.id']
		];
		$data = $this->listData('logistics',$join,'a.id,a.order_id,o.number as orderNum,a.type,a.number,a.create_time',array());
		return $data;
    }
	
	public function edit()
	{
		$data = $this->editData('logistics',$_POST,'Logistics','');
		$id = $this->oneData('logistics',[],'order_id',['id'=>input('id')])['order_id'];
		$this->editData('order',['logistics_static'=>1],'','');
	}
	
	public function show()
	{
		$join = [
			['order o','a.order_id = o.id']
		];
		$data = $this->oneData('logistics',$join,'a.id,a.order_id,o.number as orderNum,a.type,a.number,a.create_time',['a.id'=>input('id')]);
		return $data;
	}
	
	public function search()
	{
		$join = [
			['order o','a.order_id = o.id']
		];
		$data = $this->listData('logistics',$join,'a.id,a.order_id,o.number as orderNum,a.type,a.number,a.create_time',array('o.number'=>$_POST['search']));
		return $data;
	}
}