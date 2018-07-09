<?php
namespace app\admin\model;
use think\config;

class Order extends Base
{
    public function index()
    {
		$join = [
			['user u','a.user_id = u.id']
		];
		$data = $this->listData('order',$join,'a.id,a.user_id,u.username,number,paid,total,pay_static,logistics_static,a.is_delete,a.type,a.create_time',[]);
		return $data;
    }
	
	public function edit()
	{
		$this->editData('order',$_POST,'Order','');
	}
	
	public function show()
	{
		$join = [
			['user u','a.user_id = u.id'],
			['address ad','a.address_id =ad.id'],
		];
		$data = $this->oneData('order',
		$join,
		'a.is_delete,a.number,a.total,a.paid,a.num,a.type,a.pay_static,a.logistics_static,a.create_time,a.pro,
		u.username,ad.address',
		['a.id'=>input('id')]
		);
		$pro = json_decode($data['pro']);
		foreach($pro as $k=>$v){
			$a = $v;
			$id = $a->id;
			$orderPro['info'] = $this->oneData('pro',[],'title,price',['id'=>$id]);
			$orderPro['num'] = $a->num;
			$orderAllPro[] = $orderPro;
		}
		
		$data['pro'] = $orderAllPro;
		return $data;
	}
	
	public function searchUser()
	{
		$join = [
			['user u','a.user_id = u.id']
		];
		$data = $this->listData('order',$join,'a.id,user_id,username,number,paid,total,pay_static,logistics_static,a.is_delete,a.type,a.create_time',['u.username'=>$_POST['search']]);
		return $data;
	}
}