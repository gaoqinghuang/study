<?php
namespace app\common\model;

use think\Loader;
use think\Model;
use think\Validate;

class Admin extends Model
{
	protected $pk='admin_id';
	protected $table='blog_admin';

	//注册时写数据到数据库
	public function register($data){
		//验证
		$validate=Loader::validate('Register');
		if(!$validate->check($data)){
			return ['valid'=>0,'msg'=>$validate->getError()];
		}
		//检测用户是否重名
		$userInfo=$this->where('admin_username',$data['admin_username'])->find();
		if($userInfo){
			return ['valid'=>0,'msg'=>'用户已经存在'];
		}
		//对密码进行加密
		$data['admin_password']=md5($data['admin_password']);
		$result=$this->save($data);
		if($result){
			return['valid'=>1,'msg'=>'用户注册成功,请到邮箱进行激活'];
		}
	}
	//登录
	public function login($data){
		//验证
		$validate=Loader::validate('Admin');
		if(!$validate->check($data)){
			return ['valid'=>0,'msg'=>$validate->getError()];
		}
		$userInfo=$this->where('admin_username',$data['admin_username'])->where('admin_password',md5($data['admin_password']))->find();
		if(!$userInfo){
			return ['valid'=>0,'msg'=>'用户名或者密码不正确'];
		}
		//登录成功后把信息session起来
		session('admin.admin_id',$userInfo['admin_id']);
		session('admin.admin_username',$userInfo['admin_username']);
		return['valid'=>1,'msg'=>'用户登录成功'];
	}
	//密码修改
	public function pass($data){
		//验证
		$validate = new Validate([
		    'admin_password'  => 'require',
		    'new_password'  => 'require',
		    'confirm_password'  => 'require|confirm:new_password',
		],[
			'admin_password.require'=>'请输入原始密码',
			'new_password.require'=>'请输入新密码',
			'confirm_password.require'=>'请输入确认密码',
			'confirm_password.confirm'=>'确认密码跟新密码不一致',
		]);
		//修改
		if (!$validate->check($data)) {
		    return ['valid'=>0,'msg'=>$validate->getError()];
		}
		$userInfo=$this->where('admin_id',session('admin.admin_id'))->where('admin_password',md5($data['admin_password']))->find();
		if(!$userInfo){
			return ['valid'=>0,'msg'=>'原始密码不正确'];
		}
		$userInfo->admin_password=md5($data['new_password']);
		$userInfo->save();
		return['valid'=>1,'msg'=>'密码修改成功'];
	}
}