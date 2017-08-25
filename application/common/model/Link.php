<?php
namespace app\common\model;

use think\Model;

class Link extends Model{
	protected $pk='link_id';
	protected $table='blog_link';
	//添加
	public function store($data){

		$result=$this->validate(true)->save($data);
		if($result){
			return ['valid'=>1,'msg'=>'链接添加成功'];
		}else{
			return ['valid'=>0,'msg'=>$this->getError()];
		}
	}
	//取得首页数据，分页
	public function getAll(){
		return $this->order('link_sort desc')->paginate(2);
	}
	//编辑
	public function edit($data){
		$result=$this->validate(true)->save($data,['link_id'=>$data['link_id']]);
		if($result){
			return ['valid'=>1,'msg'=>'链接编辑成功'];
		}else{
			return ['valid'=>0,'msg'=>$this->getError()];
		}
	}
}