<?php
namespace app\admin\validate;

use think\Validate;

class Level extends Validate
{
    protected $rule = [
        'menu_id' =>  'require',
		'level_name' =>  'require|unique:level',
    ];

     protected $message = [
		'menu_id' => '功能模块必须',
        'level_name.require'  =>  '权限名称必须',
        'level_name.unique'  =>  '权限名称已存在',
    ];
	
	protected $scene = [
        'edit'  =>  ['menu_id','level_name'=>'require'],
    ];
}