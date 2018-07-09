<?php
namespace app\admin\validate;

use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'cate_name' =>  'require|unique:cate',
    ];

     protected $message = [
        'cate_name.require'  =>  '分类名称必须',
        'cate_name.unique'  =>  '分类名称已存在',
    ];
	
	protected $scene = [
        'edit'  =>  ['cate_name'],
		'add'   =>  ['cate_name'],
		'tadd'   =>  ['cate_name'],
		'tedit'  =>  ['cate_name'],
    ];
}