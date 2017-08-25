<?php
namespace app\admin\controller;

use app\common\model\Category;

class Article extends Common{
	//实例化一个article对象
	protected $db;
	public function _initialize(){
		parent::_initialize();
		$this->db=new \app\common\model\Article();
	}
	//文章首页
	public function index(){
		$field=$this->db->getAll(2);
		$this->assign('field',$field);
		return $this->fetch();
	}
	//文章添加
	public function store(){
		if(request()->isPost()){
			$res=$this->db->store(input('post.'));
			if($res['valid']){
				$this->success($res['msg'],'index');exit;
			}else{
				$this->error($res['msg']);exit;
			}
		}
		//分类和标签数据返回
		$cateData=(new Category())->getAll();
		$this->assign('cateData',$cateData);
		$tagData=db('tag')->select();
		$this->assign('tagData',$tagData);
		return $this->fetch();
	}

	//改变排序
	public function changeSort ()
	{
		if ( request()->isAjax() ) {
			$res = $this->db->changeSort( input( 'post.' ));
		}
	}

	//文章编辑
	public function edit(){
		if ( request()->isPost() ) {
			$res = $this->db->edit( input( 'post.' ) );
			if ( $res[ 'valid' ] ) {
				$this->success( $res[ 'msg' ] , 'index' );
				exit;
			}
			else {
				$this->error( $res[ 'msg' ] );
				exit;
			}
		}
		//旧数据返回
		$cateData=(new Category())->getAll();
		$this->assign('cateData',$cateData);
		$tagData=db('tag')->select();
		$this->assign('tagData',$tagData);
		$arc_id = input( 'param.arc_id' );
		$oldData=db('article')->find($arc_id);
		$this->assign('oldData',$oldData);
		$tag_ids=db('arc_tag')->where('arc_id',$arc_id)->column('tag_id');
		$this->assign('tag_ids',$tag_ids);
		return $this->fetch();
	}

	//删除到回收站
	public function delToRecycle(){
		$arc_id=input('param.arc_id');
		db('article')->where('arc_id',$arc_id)->update(['is_recycle' =>1]);
		$this->redirect('index');
	}
	//从回收站还原
	public function outToRecycle(){
		$arc_id=input('param.arc_id');
		db('article')->where('arc_id',$arc_id)->update(['is_recycle' =>2]);
		$this->redirect('recycle');
	}
	//收回站页面
	public function recycle(){
		$field=$this->db->getAll(1);
		$this->assign('field',$field);
		return $this->fetch();
	}
	//从回收站删除，就是彻底删除
	public function del(){
		$arc_id=input('param.arc_id');
		db('article')->where('arc_id',$arc_id)->delete();
		db('arc_tag')->where('arc_id',$arc_id)->delete();
		$this->redirect('recycle');
	}
}