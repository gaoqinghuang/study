<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

class Common extends Controller{
	//检测是否有登录，没登录就跳转到登录界面
	public function __construct(Request $request=null){
		parent::__construct($request);
		if(!session('admin.admin_id')){
			$this->redirect('admin/login/login');
		}
	}
}