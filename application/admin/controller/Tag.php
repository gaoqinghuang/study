<?php
namespace app\admin\controller;

class Tag extends Common{
	//实例化一个标签模型对象
	protected $db;
	protected function _initialize(){
		parent::_initialize();
		$this->db=new \app\common\model\Tag();
	}
	//标签分页，首页
	public function index(){
		$field=db('tag')->paginate(5);
		$this->assign('field',$field);
		return $this->fetch();
	}
	//添加和编辑
	public function store(){
		$tag_id=input('param.tag_id');
		if(request()->isPost()){
			$res=$this->db->store(input('post.'));
			if($res['valid']){
				$this->success($res['msg'],'index');exit;
			}else{
				$this->error($res['msg']);exit;
			}
		}
		//编辑时返回旧数据
		if($tag_id){
			$oldData=db('tag')->where('tag_id',$tag_id)->find();
			$this->assign('oldData',$oldData);
		}
		return $this->fetch();
	}
	//删除
	public function del(){
		$tag_id=input('param.tag_id');
		$res=$this->db->del($tag_id);
		$this->redirect('index');
	}
}