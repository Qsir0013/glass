<?php
namespace app\admin\validate;

use think\Validate;

class Pro extends Validate
{
    protected $rule = [
		'banner' => 'require',
 		'cate_id' =>  'require',
		'activity_id' =>  'require',
		'is_new' => 'require',
		'is_banner' => 'require',
        'title' =>  'require|unique:pro',
		'price' =>  'require',
		'content' =>  'require'
    ];

     protected $message = [
		'banner' => '产品banner必须',
		'cate_id'  =>  '产品分类必须',
        'activity_id'  =>  '活动类型必须',
		'is_new' => '购买人群必须',
		'is_banner' => 'banner属性必须',
        'title.require'  =>  '产品标题必须',
		'title.unique'  =>  '产品标题已存在',
		'price'  =>  '产品单价必须',
		'content'  =>  '产品详情必须',
    ];
	
	protected $scene = [
        'edit'  =>  ['banner','cate_id','activity_id','is_new','is_banner','title'=>'require','price','content'],
		'add'   =>  ['banner','cate_id','activity_id','is_new','is_banner','title','price','content']
    ];
}