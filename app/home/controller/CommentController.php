<?php

//命名空间
namespace home\controller;
//引入公共控制器
use \core\Controller;

class CommentController extends Controller{

     //博文入库
     public function insert(){
        //接收数据
        $data['a_id'] = (int)$_POST['a_id'];
        $data['c_comment'] = trim($_POST['c_comment']); 

        //验证
        if(empty($data['c_comment']) || mb_strlen($data['c_comment']) > 50){
            $this->back('评论内容不能为空！且评论长度不能超过50个字符！');
        }
        //补充数据入库
        @session_start();
        $data['u_id'] = $_SESSION['user']['id'];
        $data['c_time'] = time();

        //入库
        $c = new \home\model\CommentModel();
        if($c->autoInsert($data)){
            $this->back('评论成功！');
        }else{
            $this->back('评论失败！');
        }
    }
}