<?php
namespace app\admin\validate;

use think\Validate;
//友情链接的验证器
class Link extends Validate{
	protected $rule=[
		'link_name'=>'require',
		'link_url'=>'require|url',
		'link_sort'=>'require|between:1,9999',
	];
	protected $message=[
		'link_name.require'=>'请输入链接名称',
		'link_url.require'=>'请输入链接地址',
		'link_url.url'=>'链接地址格式错误',
		'link_sort.require'=>'请输入排序',
		'link_sort.between'=>'排序只能是1到9999',
	];
}