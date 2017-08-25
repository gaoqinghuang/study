<?php
namespace app\admin\controller;
 
use think\Session;
use app\common\model\Admin;

class Entry extends Common{
	//首页
	public function index(){
		return $this->fetch();
	}
	//密码修改
	public function pass(){
		if(request()->isPost()){
			$res=(new Admin())->pass(input('post.'));
			if($res['valid']){
				$this->success($res['msg'],'admin/entry/index');exit;
			}else{
				$this->error($res['msg']);exit;
			}
		}
		return $this->fetch();
	}
	//注销
	public function out(){
		Session::delete('admin.admin_id');
		$this->redirect('login');
	}
}