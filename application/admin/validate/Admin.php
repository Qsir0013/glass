<?php
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'levelid' =>  'require|unique:admin',
		'username' =>  'require|unique:admin',
		'passwd' =>  'require',
		'phone' =>  'require',
    ];

     protected $message = [
		'levelid.require' => '角色必须',
		'levelid.unique'  =>  '角色已存在',
        'username.require' => '用户名必须',
		'username.unique' => '用户名已存在',
		'passwd' => '密码必须',
		'phone' => '电话必须',
    ];
	
	protected $scene = [
        'edit'  =>  ['username'=>'require','passwd'=>'require','phone'=>'require'],
		'cpasswd'  =>  ['passwd'=>'require','phone'=>'require'],
    ];
}