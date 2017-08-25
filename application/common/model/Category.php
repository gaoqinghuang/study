<?php
namespace app\common\model;

use think\Loader;
use think\Model;
use think\Validate;
use houdunwang\arr\Arr;

class Category extends Model
{
	protected $pk='cate_id';
	protected $table='blog_cate';
	//数据添加
	public function store($data){
		$result = $this->validate(true)->save($data);
		if(false === $result){
			return ['valid'=>0,'msg'=>$this->getError()];
		}else{
			return ['valid'=>1,'msg'=>'添加成功'];
		}
	}
	//首页数据
	public function getAll(){
		return Arr::tree(db('cate')->order('cate_sort desc,cate_id')->select(), 'cate_name', $fieldPri = 'cate_id', $fieldPid = 'cate_pid');
	}
	//获取所有的栏目，并排成树状
	public function getCateData($cate_id){
		$cate_ids=$this->getSon(db('cate')->select(),$cate_id);
		$cate_ids[]=$cate_id;
		$field=db('cate')->whereNotIn('cate_id',$cate_ids)->select();
		return Arr::tree($field,'cate_name','cate_id','cate_pid');

	}
	//取得子栏目
	public function getSon($data,$cate_id){
		static $stem=[];
		foreach($data as $k=>$v){
			if($cate_id==$v['cate_pid']){
				$stem[]=$v['cate_id'];
				$this->getSon($data,$v['cate_id']);
			}
		}
		return $stem;
	}
	//编辑
	public function edit($data){
		$result=$this->validate(true)->save($data,[$this->pk=>$data['cate_id']]);
		if($result){
			return ['valid'=>1,'msg'=>'编辑成功'];
		}else{
			return ['valid'=>0,'msg'=>$this->getError()];
		}
	}
	//删除
	public function del($cate_id)
	{
		$cate_pid = $this->where('cate_id',$cate_id)->value('cate_pid');
		$this->where('cate_pid',$cate_id)->update(['cate_pid'=>$cate_pid]);
		if(Category::destroy($cate_id))
		{
			return ['valid'=>1,'msg'=>'删除成功'];
		}else{
			return ['valid'=>0,'msg'=>'删除失败'];
		}
	}
}