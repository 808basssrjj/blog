<?php
namespace admin\controller;
use \core\Controller;

class PrivilegeController extends Controller{

	//登陆页面
	public function index(){
		$this->display('login.html');
	}

	//验证登陆信息
	public function check(){
		//1.接受数据
		$username = trim($_POST['u_username']);
		$password = trim($_POST['u_password']);
		$captcha = trim($_POST['captcha']);

		//验证验证码合法性
		if(empty($captcha)){
			$this->error('验证码不能为空!','index');
		}

		//2.合法性验证
		if(empty($username) || empty($password)){
			//调用公共控制器跳转提示方法： 重新进入登录表单界面）
			$this->error('用户名和密码都不能为空！','index');
		}

		//验证验证码是否有效
		if(!\vendor\Captcha::checkCaptcha($captcha)){
			$this->error('验证码错误!','index');
		}

		//3.验证用户名是否存在 调用模型
		$u = new \admin\model\UserModel();
		$user = $u->getUserByUsername($username);
		//var_dump($user);

		//4.判断用户是否存在
		if(!$user){
			$this->error('当前用户名不存在或用户名错误','index');
		}

		//5.密码验证
		if($user['u_password'] !==md5($password)){
			$this->error('密码错误','index');
		}


		//6.将用户登录后信息保存到session
		@session_start();
		$_SESSION['user']=$user;

		//7.免登录
		if(isset($_POST['rememberMe'])){
			setcookie('id',$user['id'],time()+7*24*3600);
		}


		//6.登录成功 跳转首页
		$this->success('欢迎登录后台管理系统','index','Index');
		
	}

	//退出系统
	public function logout(){
		//删除session
		session_destroy();

		//清除可能存在的cookie
		setcookie('id','',1);

		//提示 退出成功
		$this->success('退出成功','','index');
	}

	//获取验证码图片
	public function	captcha(){
		//调用验证码类
		\vendor\Captcha::getCaptcha();
	}
}