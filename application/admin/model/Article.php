<?php
namespace app\admin\model;

class Article extends Base
{
    public function index()
    {
		$data = $this->listData('article',array(),'id,title,num,update_time,static','is_delete = 0');
		return $data;
    }
	
	public function check()
    {
		$_POST['img'] = $this->up('img',204800,'jpg');
		if(!empty($_POST['targs_id'])){
			$targs = json_encode($_POST['targs_id']);
			$_POST['targs_id'] = $targs;
		}
        $this->addCheck('Article','article',$_POST,'add');
    }
	
	public function disable()
	{
		$this->setDisable('article');
	}
	
	public function enable()
	{
		$this->setEnable('article');
	}
	
	public function isDelete()
	{
		$this->setIsDelete('article');
	}
	
	public function show()
	{
		$data = $this->showData('article',array(),'img,title,author,create_time,cate_id,targs_id,menu_id,keywords,des,content,static,source,num,comment',array());
		$data['oldimg'] = $data['img'];
		$data['img'] = findone('images',array(),'src',array('id'=>$data['img']))['src'];
		$data['targs_id'] = json_decode($data['targs_id']);
		return $data;
	}
	
	public function edit()
	{
		$_POST['img'] = $this->up('img',204800,'jpg');
		if(!empty($_POST['targs_id'])){
			$targs = json_encode($_POST['targs_id']);
			$_POST['targs_id'] = $targs;
		}
		$_POST['update_time'] = date("Y-m-d H:i:s");
		$this->editData('article',$_POST,'Article','edit');
	}
	
	public function acateList(){
		$data = findMore('cate',array(),'id,cate_name',array('type'=>1,'is_delete'=>0),'id');
        return $data;
	}
	
	public function tcateList(){
		$data = findMore('cate',array(),'id,cate_name',array('type'=>2,'is_delete'=>0),'id');
        return $data;
	}
	
	public function menu(){
		$data = findMore('menu',array(),'id,menu_name,controller',array('type'=>1,'is_delete'=>0),'id');
        return $data;
	}
}
