<?php
namespace app\admin\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule = [
		'menu_id' =>  'require',
		'cate_id' =>  'require',
        'targs_id' =>  'require',
		'source' =>  'require',
		'title' =>  'require|unique:article',
		'author' =>  'require',
		'keywords' =>  'require',
		'des' =>  'require|unique:article',
		'content' =>  'require|unique:article',
    ];

     protected $message = [
		'menu_id'  =>  '导航模块必须',
        'cate_id'  =>  '文章类别必须',
        'targs_id'  =>  '文章标签必须',
		'source'  =>  '文章来源必须',
		'title.require'  =>  '文章标题必须',
		'title.unique'  =>  '文章标题已存在',
		'author'  =>  '作者必须',
		'keywords'  =>  '文章关键字必须',
		'des.require'  =>  '文章描述必须',
		'des.unique'  =>  '文章描述已存在',
		'content.require'  =>  '文章必须',
		'content.unique'  =>  '文章已存在',
    ];
	
	protected $scene = [
        'edit'  =>  ['menu_id','cate_id','targs_id','source','title'=>'require','author','keywords','des'=>'require','content'=>'require'],
		'add'   =>  ['menu_id','cate_id','targs_id','source','title','author','keywords','des','content']
    ];
}