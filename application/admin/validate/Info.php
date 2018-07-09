<?php
namespace app\admin\validate;

use think\Validate;

class Info extends Validate
{
    protected $rule = [
		'title' =>  'require',
        'admin' =>  'require',
		'email' =>  'require',
		'qq' =>  'require',
    ];

     protected $message = [
		'title'  =>  '网站标题必须',
        'admin'  =>  '站长必须',
        'email'  =>  '邮箱必须',
		'qq'  =>  '联系QQ必须',
    ];
	
	protected $scene = [
        'edit'  =>  ['title','admin','email','qq'],
    ];
}