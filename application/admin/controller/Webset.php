<?php
namespace app\admin\controller;


class Webset extends Common{
	//实例化一个网站配置对象
	protected $db;

	public function _initialize(){
		parent::_initialize();
		$this->db=new \app\common\model\Webset();
	}
	//首页
	public function index(){
		$field=db('webset')->select();
		$this->assign('field',$field);
		return $this->fetch();
	}
	//编辑
	public function edit(){
		if(request()->isAjax()){
			$res=$this->db->edit(input('post.'));
		}
	}
}