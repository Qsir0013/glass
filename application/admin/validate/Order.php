<?php
namespace app\admin\validate;

use think\Validate;

class Order extends Validate
{
    protected $rule = [
		'total' =>  'require'
    ];

     protected $message = [
		'total'  =>  '订单总价必须'
    ];
}