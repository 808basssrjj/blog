<?php
namespace admin\controller;
use \core\Controller;

class IndexController extends Controller{

    //显示首页
    public function index(){

        //开启session
        @session_start();

        //获取用户数量
        $u=new \admin\model\UserModel();
        $counts=$u->getCounts();

        //显示首页
        $this->assign('counts',$counts);
        $this->display('index.html');
    }
}