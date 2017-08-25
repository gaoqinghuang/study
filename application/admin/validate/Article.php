<?php
namespace app\admin\validate;

use think\Validate;
//文章的验证器
class Article extends Validate{
	protected $rule=[
		'arc_title'=>'require',
		'arc_author'=>'require',
		'arc_content'=>'require',
		'arc_digest'=>'require',
		'arc_sort'=>'require|between:1,9999',
		'arc_thumb'=>'require',
		'cate_id'=>'notIn:0',
	];
	protected $message=[
		'arc_title.require'=>'请输入文章标题',
		'arc_author.require'=>'请输入文章作者',
		'arc_content.require'=>'请输入文章内容',
		'arc_digest.require'=>'请输入文章摘要',
		'arc_sort.require'=>'请输入文章排序',
		'arc_sort.between'=>'排序必须要在1到9999之间',
		'cate_id.notIn'=>'请选择所属分类',
		'arc_thumb.require'=>'请选择缩略图',
	];
}