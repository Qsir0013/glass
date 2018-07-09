<?php
namespace app\admin\validate;

use think\Validate;

class Logistics extends Validate
{
    protected $rule = [
        'number' =>  'require',
    ];

     protected $message = [
        'number'  =>  '快递单号必须'
    ];
}