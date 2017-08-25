<?php
namespace app\common\model;

use think\Model;

class Tag extends Model{
	protected $pk='tag_id';
	protected $table='blog_tag';
	//添加，验证
	public function store($data){
		$result=$this->validate(true)->allowField(true)->save($data,$data['tag_id']);
		if($result){
			return ['valid'=>1,'msg'=>'编辑成功'];
		}else{
			return ['valid'=>0,'msg'=>$this->getError()];
		}
	}
	//删除
	public function del($tag_id){
		db('tag')->delete($tag_id);
	}
}