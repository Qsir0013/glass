<?php
namespace app\admin\model;

class Level extends Base
{
    public function index()
    {
		$data = $this->listData('level',array(),'id,level_name,update_time,static',array('is_delete'=>0));
        return $data;
    }
	
	public function disable()
	{
		$this->setDisable('level');
	}
	
	public function enable()
	{
		$this->setEnable('level');
	}
	
	public function isDelete()
	{
		$this->setIsDelete('level');
	}
	
	public function show()
	{
		$data['info'] = $this->showData('level',array(),'level_name,menu_id,create_time,update_time,static','');
		$data['info']['menu_id'] = json_decode($data['info']['menu_id']);
		return $data;
	}
	
	public function menu()
	{
		$menu = findMore('menu',array(),'id,menu_name,controller',array('is_delete'=>0,'pid'=>0),'id');
		return $menu;
	}
	
	public function add()
	{
		$menu = $_POST['menu_id'];
		foreach($menu as $k=>$v){
			$nav = findMore('menu',array(),'id',array('pid'=>$v),'');
			foreach($nav as $k=>$v){
				$a[] = $v['id'];
			}
		}
		$_POST['menu_id'] = json_encode(array_merge([1],$menu,$a));
		$this->addCheck('Level','level',$_POST,'');
	}
	
	public function edit()
	{
		$_POST['menu_id'][] = 1;
		$_POST['menu_id'] = json_encode($_POST['menu_id']);
		$_POST['update_time'] = date("Y-m-d H:i:s");
		$this->editData('level',$_POST,'Level','edit');
	}
}
