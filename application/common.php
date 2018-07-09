<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Db;
use think\Loader;
use PHPMailer\PHPMailer\PHPMailer;
use think\config;
use think\Cache;

function isMobile()
{ 
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
}

//获取ip
function getip() { 
        $unknown = 'unknown'; 
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){ 
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
        }elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) { 
            $ip = $_SERVER['REMOTE_ADDR']; 
        } 
        /**
         * 处理多层代理的情况
         * 或者使用正则方式：$ip = preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : $unknown;
         */
        if (false !== strpos($ip, ',')) $ip = reset(explode(',', $ip)); 
        return $ip; 
}

//查询条数
function dataCount($table,$where)
{
	$data = Db::name($table)->where($where)->count();
	if($data){
		return $data;
	}else{
		return false;
	}
}

//单条查询
function findone($table,$join,$field,$where)
{
	$data = Db::name($table)->alias('a')->join($join)->field($field)->where($where)->find();
	if($data){
		return $data;
	}else{
		return false;
	}
}
 
//多条查询
function findMore($table,$join,$field,$where,$order,$num='')
{
	$data = Db::name($table)->alias('a')->join($join)->field($field)->where($where)->order($order)->limit($num)->select();
	if($data){
		return $data;
	}else{
		return false;
	}
}

//分页
function findMorePg($table,$join,$field,$where,$order,$num)
{
	$data = Db::name($table)->alias('a')->join($join)->field($field)->where($where)->order($order)->paginate($num);
	
	if($data->items()!=array()){
		return $data;
	}else{
		return false;
	}
}

//添加数据
function addData($table,$data)
{
	$data = Db::name($table)->insert($data);
	if($data){
		return $data;
	}else{
		return false;
	}
}

//递归处理
function getTree($data, $pId)
{
	$tree = array();
	foreach($data as $k => $v)
	{
		if($v['pid'] == $pId)
		{
		$v['cnav'] = getTree($data, $v['id']);
		$tree[] = $v;
		}
	}
		return $tree;
}

//弹出提示信息，返回操作之前
function msg($msg)
{
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	echo "<script>alert('$msg');window.location.href=document.referrer; </script>";
}

//弹出提示信息,返回正在操作的时候
function msgback($msg)
{
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	echo "<script>alert('$msg');window.location.href=history.go(-1);  </script>";
}

//添加数据返回id
function addId($table,$data){
	$data = Db::name($table)->insertGetId($data);
	if($data){
		return $data;
	}else{
		return false;
	}
}

//调用验证
function checkData($val,$data,$scene)
{
	$validate = Loader::validate($val);
	if(!$validate->scene($scene)->check($data)){
		msgback($validate->getError());
	}else{
		return true;
	}
}

//逻辑删除
function isDelete($table,$where,$data)
{
	$data = Db::name($table)->where($where)->update($data);
	if($data){
		return $data;
	}else{
		return false;
	}
}

//删除数据
function del($table,$where)
{
	$data = Db::name($table)->where($where)->delete();
	if($data){
		return $data;
	}else{
		return false;
	}
}


//数据修改
function edit($table,$where,$data)
{
	$data = Db::name($table)->where($where)->update($data);
	if($data){
		return $data;
	}else{
		return false;
	}
}

//上传文件
function upFile($fileName,$size,$format='*')
{
	$file = request()->file($fileName);
    $info = $file->validate(['size'=>$size,'ext'=>$format])->move(ROOT_PATH . 'public' . DS . 'uploads');
    if($info){
		$src = $info->getSaveName();
        $data['src'] = str_replace("\\","/",$src);
		return addId('images',$data);
    }else{
        msgback($file->getError());
		die;
    }
}

//获取数据数量
function num($table,$where)
{
	$data = Db::name($table)->where($where)->count();
	if($data){
		return $data;
	}else{
		return 0;
	}
}

//设置缓存
function setCache($type,$name,$value,$time=0)
{
	return Cache::store($type)->set($name,$value,$time);
}

//获取缓存
function getCache($type,$name)
{
	return Cache::store($type)->get($name);
}

//分组查询
function group($table,$field,$group,$where,$order,$num)
{
	$data = Db::name($table)->field($field)->group($group)->where($where)->order($order)->limit($num)->select();
	if($data){
		return $data;
	}else{
		return false;
	}
}

//验证数组参数是否为空
function checkParameter($res)
{
	foreach($res as $k=>$v){
		if($v===''||$v===NULL){
			$data['code'] = 202;
			$data['msg'] = '参数' . $k . '不能为空';
		}else{
			$data[$k] = $v;
		}
	}
	return $data;
}