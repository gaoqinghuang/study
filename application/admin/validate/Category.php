<?php
namespace app\admin\validate;

use think\Validate;
//栏目的验证器
class Category extends Validate{
	protected $rule=[
		'cate_name'=>'require',
		'cate_sort'=>'require|number|between:1,9999',
	];
	protected $message=[
		'cate_name.require'=>'请输入栏目名称',
		'cate_sort.require'=>'请输入栏目排序',
		'cate_sort.number'=>'排序必须为数字',
		'cate_sort.between'=>'请输入1到9999之间的数',
	];
}