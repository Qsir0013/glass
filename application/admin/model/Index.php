<?php
namespace app\admin\model;

class Index extends Base
{
    public function index()
    {
		//$today = mktime(0,0,0);
		//$data['comment'] = $this->statistics('comment',array('is_delete'=>0));
		$data['user'] = $this->statistics('user',array('is_delete'=>0));
		$data['pro'] = $this->statistics('pro',array('is_delete'=>0));
		$browse = findMore('browse',array(),'*',array('date'=>date("Y-m-d")),'id');
		$num = 0;
		if($browse){
			foreach($browse as $k=>$v){
				$num += $v['num'];
			}
			$data['browse'] = $num;
		}else{
			$data['browse'] = $num;
		}
        return $data;
    }
	
	public function cinfo()
	{
		$check = checkData('Admin',$_POST,'cpasswd');
		if($check){
			$_POST['passwd'] = md5($_POST['passwd']);
			edit('admin',array('id'=>session('Yj')['id']),$_POST);
			session('Yj',NULL);
		}
	}
}
