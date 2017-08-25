<?php
namespace app\admin\validate;

use think\Validate;
//注册的验证器
class Register extends Validate{
	protected $rule=[
		'admin_username'=>'require',
		'admin_password'=>'require',
		'admin_email'=>'require|email',
	];
	protected $message=[
		'admin_username.require'=>'请输入用户名',
		'admin_password.require'=>'请输入密码',
		'admin_email.require'=>'请输入邮箱',
		'admin_email.email'=>'邮箱格式不正确',
	];
}