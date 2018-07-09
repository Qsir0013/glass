<?php
namespace app\admin\validate;

use think\Validate;

class Addresslink extends Validate
{
    protected $rule = [
        'url_name' =>  'require|unique:link',
		'url' =>  'require|unique:link',
		'admin' =>  'require',
		'email' =>  'require',
		'describe' =>  'require'
    ];

     protected $message = [
        'url_name.require'  =>  '网站称必须',
        'url_name.unique'  =>  '网站名称已存在',
		'url.require'  =>  '网站链接必须',
        'url.unique'  =>  '网站链接已存在',
		'admin.require'  =>  '站长必须',
		'email.require'  =>  '邮箱必须',
		'describe.require'  =>  '网站描述必须'
    ];
	
	protected $scene = [
        'edit'  =>  ['url_name'=>'require','url'=>'require','admin','email','describe'],
		'add'  =>  ['url_name','url','admin','email','describe']
    ];
}