<?php
namespace app\admin\controller;


class Category extends Common{
	//实例化一个category模型，分类
	protected $db;
	protected function _initialize(){
		parent::_initialize();
		$this->db=new \app\common\model\Category();
	}
	//返回分类界面
	public function index(){
		$field=$this->db->getAll();

		$this->assign('field',$field);
		return $this->fetch();
	}
	//添加
	public function store(){
		if(request()->isPost()){
			$res=$this->db->store(input('post.'));
			if($res['valid']){
				$this->success($res['msg'],'index');exit;
			}else{
				$this->error($res['msg']);exit;
			}
		}
		return $this->fetch();
	}
	//添加子分类
	public function addSon(){
		if(request()->isPost()){
			$res=$this->db->store(input('post.'));
			if($res['valid']){
				$this->success($res['msg'],'index');exit;
			}else{
				$this->error($res['msg']);exit;
			}
		}
		//获取父栏目
		$cate_id=input('param.cate_id');
		$data=$this->db->where('cate_id',$cate_id)->find();
		$this->assign('data',$data);
		return $this->fetch();
	}

	//编辑
	public function edit(){
		if(request()->isPost()){
			$res=$this->db->edit(input('post.'));
			if($res['valid']){
				$this->success($res['msg'],'index');exit;
			}else{
				$this->error($res['msg']);exit;
			}
		}
		//获取旧数据
		$cate_id=input('param.cate_id');
		$oldData=$this->db->where('cate_id',$cate_id)->find();
		$this->assign('oldData',$oldData);
		$cateData=$this->db->getCateData($cate_id);
		$this->assign('cateData',$cateData);
		return $this->fetch();
	}
	//删除栏目
	public function del(){
		$cate_id=input('param.cate_id');
		$res=$this->db->del($cate_id);
		if($res['valid'])
		{
			$this->success($res['msg'],'index');exit;
		}else{
			$this->error($res['msg']);exit;
		}
	}
}