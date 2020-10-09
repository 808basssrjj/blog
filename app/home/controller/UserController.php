<?php

//命名空间
namespace home\controller;
//引入公共控制器
use \core\Controller;

class UserController extends Controller{

    //登录
    public function check(){
        //接收数据
        $u_username =trim($_POST['u_username']);
        $u_password =trim($_POST['u_password']);

        //合法性验证
        if(empty($u_username) || empty($u_password)){
            $this->error('用户名或密码不能为空!','index','index');
        }

        //有效性验证
        $u =new \home\model\UserModel();
        if(!$user=$u->checkUsername($u_username)){
            $this->error('当前用户名:' .$u_username.'不存在!','index','index');
        }

        //密码验证
		if($user['u_password'] !==md5($u_password)){
			$this->error('密码错误','index','index');
        }
        
        //登录成功
        @session_start();
        $_SESSION['user'] = $user;
        $this->success('登录成功！','index','index');


    }

    //退出系统
	public function logout(){

        @session_start();

		//删除session
		session_destroy();


		//提示 退出成功
		$this->success('退出成功!欢迎下次登录','index','index');
    }

    //获取验证码图片
    public function	captcha(){
		//调用验证码类
		\vendor\Captcha::getCaptcha();
	}
    
    //注册
    public function register(){
        //接收数据
        $data['u_username'] =trim($_POST['username']);
        $data['u_password'] =trim($_POST['password']);
        $captcha = trim($_POST['captcha']);

        if(empty($captcha)){
		$this->error('验证码不能为空','index','index');

        }
        //合法性验证
        if(empty($data['u_username']) || empty($data['u_password'])){
            $this->back('用户名和密码不能为空!');
        }

        //有效性验证
        if(!\vendor\Captcha::checkCaptcha($captcha)){
            $this->back('验证码错误!');
        }

        //用户名验证
        $u=new \home\model\UserModel();
        if($u->checkUsername($data['u_username'])){
            $this->back('用户名已经存在!');

        }

        //注册  数据入库
        $data['u_reg_time']=time();
        $data['u_password']=md5($data['u_password']);
        if($u->autoInsert($data)){
            $this->success('注册成功!','index','index');
        }else{
            $this->error('注册成功!','index','index');
        }
    }

  
    
	
}