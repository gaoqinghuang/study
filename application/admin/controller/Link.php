<?php
namespace app\admin\controller;


class Link extends Common{
	//实例化友情链接模式
	protected $db;
	public function _initialize(){
		parent::_initialize();
		$this->db=new \app\common\model\Link();
	}
	//友情链接首页
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
	//编辑
	public function edit(){
		if(request()->isPost()){
			$res = $this->db->edit( input( 'post.' ) );
			if ( $res[ 'valid' ] ) {
				$this->success( $res[ 'msg' ] , 'index' );
				exit;
			}else {
				$this->error( $res[ 'msg' ] );
				exit;
			}
		}
		//获取旧数据
		$link_id=input('param.link_id');
		$oldData=db('link')->find($link_id);
		$this->assign('oldData',$oldData);
		return $this->fetch();
	}
	//删除友情链接
	public function del(){
		$link_id=input('param.link_id');
		db('link')->where('link_id',$link_id)->delete();
		$this->redirect('index');
	}
}
