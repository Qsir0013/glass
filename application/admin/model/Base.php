<?php
namespace app\admin\model;

use think\Model;

class Base extends Model
{
	//判断权限
	public function checkLevel()
	{
		$controller = request()->controller();
		$menuId = findone('menu',array(),'id',array('controller'=>$controller))['id'];
		$menu = json_decode(findone('level',array(),'menu_id',array('id'=>session('Yj')['levelid']))['menu_id']);
		if(!in_array($menuId,$menu)){
			return true;
		}
	}
	
	//导航
	public function menu(){
		$menu = json_decode(findone('level',array(),'menu_id',array('id'=>session('Yj')['levelid']))['menu_id']);
		foreach($menu as $k=>$v){
			$nav[] = findone('menu',array(),'id,menu_name,url,pid,controller,icon',array('id'=>$v));
		}
		$nav = getTree($nav,0);
		return $nav;
	}
	
	//首页统计
	public function statistics($table,$where)
	{
		$data = dataCount($table,$where);
		if($data){
			return $data;
		}else{
			$data = 0;
			return $data;
		}
	}
	
	//列表页
	public function listData($table,$join,$field,$where,$order='id desc',$num=5)
	{
		$data = findMorePg($table,$join,$field,$where,$order,$num);
		$data = isset($data)&&!empty($data)?$data:'';
		return $data;
	}
	
	//添加数据并验证
	public function addCheck($vClass,$table,$data,$scene)
	{
		$check = checkData($vClass,$data,$scene);
		if($check){
			$newLink = addData($table,$data);
		}
		if($newLink===false){
			msg('添加错误！');
		}
	}
	
	//设置禁用
	public function setDisable($table)
	{
		$data['static']=0;
		$id = input('id');
		$data = isDelete($table,array('id'=>$id),$data);
		if($data){
			return $data;
		}else{
			msg('操作失败！');
		}
	}
	
	//设置启用
	public function setEnable($table)
	{
		$data['static']=1;
		$id = input('id');
		$data = isDelete($table,array('id'=>$id),$data);
		if($data){
			return $data;
		}else{
			msg('操作失败！');
		}
	}
	
	//逻辑删除
	public function setIsDelete($table)
	{
		$data['is_delete']=1;
		$id = input('id');
		$data = isDelete($table,array('id'=>$id),$data);
		if($data){
			msg('删除成功！');
		}else{
			msg('操作失败！');
		}
	}
	
	//查看数据
	public function showData($table,$join,$field,$where)
	{
		$edit['is_new']=0;
		$id = input('id');
		$where=array('a.id'=>$id);
		$data = findone($table,$join,$field,$where);
		$is_new = isset($data['is_new'])&&!empty($data['is_new'])?$data['is_new']:'';
		if($is_new!=''&&$is_new===1){
			$edit = edit($table,array('id'=>$id),$edit);
			if($data&&$edit){
				return $data;
			}else{
				msg('查询失败！');
			}
		}
		
		if($data){
			return $data;
		}else{
			msg('查询失败！');
		}
		
	}
	
	//查找一条数据
	public  function oneData($table,$join,$field,$where)
	{
		$data = findone($table,$join,$field,$where);
		if($data){
			return $data;
		}else{
			msg('查询失败！');
		}
	}
	
	//修改数据
	public function editData($table,$data,$vClass,$scene)
	{
		$id = input('id');
		$id = isset($id)&&!empty($id)?$id:1;
		$check = checkData($vClass,$data,$scene);
		if($check){
			$data = edit($table,array('id'=>$id),$data);
			return $data;
		}
		if($data===false){
			msg('未作任何修改！');
		}
	}
	
	//单文件上传
	public function up($filename,$size,$format='*')
	{
		if($_FILES[$filename]['name']===''){
			$file = $_POST[$filename];
			return $file;
		}else{
			if($_FILES[$filename]['size']>0){
				$file = upFile($filename,$size,$format);
				return $file;
			}
			if($_FILES[$file]['size']===0){
				msgback('图片大于2M，无法上传！请选择200k以内,后缀为'.$format.'的文件');
			}
		}
	}
	
	//多文件上传
	public function ups($filename)
	{
		$files = request()->file($filename);
		foreach($files as $file){
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			if(!$info){
				msgback($file->getError());
			}else{
				$src = $info->getSaveName();
				$img['src'] = str_replace("\\","/",$src);
				$imgid[] = addId('images',$img);
			}  
		}
		return $imgid;
	}
}