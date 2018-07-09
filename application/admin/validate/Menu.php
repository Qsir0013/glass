<?php
namespace app\admin\validate;

use think\Validate;

class Menu extends Validate
{
    protected $rule = [
		'menu_name' =>  'require',
        'keywords' =>  'require',
		'description' =>  'require'
    ];

     protected $message = [
		'menu_name'  =>  '导航栏目必须',
        'keywords'  =>  '导航模块关键字必须',
        'description'  =>  '导航模块描述必须',
    ];
	
	protected $scene = [
        'edit'  =>  ['menu_name','keywords','description'],
    ];
}