<?php
namespace app\admin\controller;

use app\common\model\Admin;
use think\Controller;

class Login extends Controller{
	//登录界面
	public function login(){
		if(request()->isPost()){
			$res=(new Admin())->login(input('post.'));
			if($res['valid']){
				$this->success($res['msg'],'admin/entry/index');exit;
			}else{
				$this->error($res['msg'],'admin/login/login');
				exit;
			}
		}
		return $this->fetch();
	}
}