<?php
namespace app\admin\controller;
 
use think\Controller;
use app\common\model\Admin;
use email\Smtp;
class Register extends Controller{
	//注册界面
	public function register(){	

		if(request()->isPost()){
			$res=(new Admin())->register(input('post.'));
			if($res['valid']){
				//注册成功，往邮箱发封激活邮件
				$MailServer = "smtp.139.com"; //SMTP服务器
			    $MailPort = 25; //SMTP服务器端口
			    $smtpMail = "15859573992@139.com"; //SMTP服务器的用户邮箱
			    $smtpuser = "15859573992@139.com"; //SMTP服务器的用户帐号
			    $smtppass = "a8848971"; //SMTP服务器的用户密码
			    
			    //创建$smtp对象 这里面的一个true是表示使用身份验证,否则不使用身份验证.
			    $smtp = new Smtp($MailServer, $MailPort, $smtpuser, $smtppass, true); 
			    $smtp->debug = false; 
			    $mailType = "HTML"; //信件类型，文本:text；网页：HTML
			    $email = input('post.admin_email');  //收件人邮箱
			    $username=input('post.admin_username');//收件人用户名
			    $emailTitle = "小高博客用户帐号激活"; //邮件主题
			    $emailBody = "亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/>  
					<a href='http://www.tp5.com/admin/register/activation.html?username=".$username."'>http://www.tp5.com/admin/register/activation.html</a>
			    	如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。<br/>
			    	如果此次激活请求非你本人所发，请忽略本邮件。<br/><p 
			    	style='text-align:right'>-------- 小高 敬上</p>";
			    
			    // sendmail方法
			    // 参数1是收件人邮箱
			    // 参数2是发件人邮箱
			    // 参数3是主题（标题）
			    // 参数4是邮件内容  参数是内容类型文本:text 网页:HTML
			    $rs = $smtp->sendmail($email, $smtpMail, $emailTitle, $emailBody, $mailType);
				$this->success($res['msg'],'admin/login/login');exit;
			}else{
				$this->error($res['msg'],'admin/register/register');
				exit;
			}
		}
		return $this->fetch();
	}
	//注册时的邮箱验证激活
	public function activation(){
		$admin_username=(input('get.username'));
		$result=db('admin')->where('admin_username',$admin_username)->update(['admin_activation' => 1]);
		if($result){
			echo "激活成功";
		}
		
	}
}