<?php
namespace app\common\model;

use think\Model;

class Webset extends Model{
	protected $pk='webset_id';
	protected $table='blog_webset';
	//编辑站点配置
	public function edit($data){
		$this->validate([
			'webset_value'=>'require',
			],[
			'webset_value.require'=>'请输入配置值'
			])->save($data,[$this->pk=>$data['webset_id']]);
	}
}