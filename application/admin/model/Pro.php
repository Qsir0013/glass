<?php
namespace app\admin\model;

class Pro extends Base
{
    public function index()
    {
		$data = $this->listData('pro',[],'id,title,price,create_time,static,is_banner',array('a.is_delete'=>0));
        return $data;
    }
	
	public function disable()
	{
		$this->setDisable('pro');
	}
	
	public function enable()
	{
		$this->setEnable('pro');
	}
	
	public function enbanner()
	{
		$data['is_banner']=1;
		$id = input('id');
		$data = isDelete('pro',array('id'=>$id),$data);
		if($data){
			return 1;
		}else{
			msg('操作失败！');
		}
	}
	
	public function disbanner()
	{
		$data['is_banner']=0;
		$id = input('id');
		$data = isDelete('pro',array('id'=>$id),$data);
		if($data){
			return 1;
		}else{
			msg('操作失败！');
		}
	}
	
	public function isDelete()
	{
		$this->setIsDelete('pro');
	}
	
	public function show()
	{
		$data = $this->showData('pro',array(),'cate_id,activity_id,title,price,img,content,is_new,is_banner,banner',array('is_delete'=>0));
		$banner = $data['banner'];
		$data['old_banner'] = $banner;
		$banner = findone('images',array(),'src',array('id'=>$banner))['src'];
		$data['banner'] = $banner;
		$img = json_decode($data['img']);
		$data['oldImg'] = $img;
		if($img){
			foreach($img as $k=>$v){
				$img = findone('images',array(),'src',array('id'=>$v))['src'];
				$all[] = $img;
			}
			$data['img'] = $all;
		}else{
			$data['img'] = '';
			$data['oldImg'] = '';
		}
		return $data;
	}
	
	public function proCate()
	{
		$data = findMore('cate',array(),'id,cate_name',array('is_delete'=>0,'type'=>1),'id');
		return $data;
	}
	
	public function hdCate()
	{
		$data = findMore('cate',array(),'id,cate_name',array('is_delete'=>0,'type'=>2),'id');
		return $data;
	}
	
	public function add()
	{
		if($_FILES['banner']['name']!=''){			
			$_POST['banner'] = $this->up('banner',20480000,'png,jpg,jpeg,gif');
		}else{
			$_POST['banner'] = '';
		}
		if($_FILES['img']['name'][0]!=''){
			$_POST['img'] = json_encode($this->ups('img'));
		}else{
			$_POST['img'] = '';
		}
		$this->addCheck('Pro','pro',$_POST,'add');
	}
	
	public function edit()
	{
		
		if($_FILES['banner']['name']!=''){
			$_POST['banner'] = $this->up('banner',20480000,'png,jpg,jpeg,gif');
		}
		if($_FILES['img']['name'][0]!=''){
			$_POST['img'] = json_encode($this->ups('img'));
		}else{
			$_POST['img'] = isset($_POST['oldImg'])&&!empty($_POST['oldImg'])?json_encode($_POST['oldImg']):'';
		}
		unset($_POST['oldImg']);
		$this->editData('pro',$_POST,'Pro','edit');
	}
}
