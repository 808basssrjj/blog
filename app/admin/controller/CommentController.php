<?php

#评论控制器
namespace admin\controller;
use \core\Controller;

class CommentController extends Controller{
    
    //获取全部评论
    public function index(){

        //获取分页数据
		$page = $_GET['page'] ?? 1;
		global $config;
        $pagecount = $config['admin']['comment_pagecount'] ?? 5;
        
        //获取全部评论
        $c= new \admin\model\CommentModel();
        $comments=$c->getAllComments();

        //获取总记录数
		$counts = $c->getCounts();

        //使用分页类
		$cond = array('a'=>A,'c'=>C,'p'=>P);
		$pagestr = \vendor\Page::clickPage(URL . 'index.php',$counts,$pagecount,$page,$cond);
        // echo '<pre>';
        // var_dump( $comments);
        
        $this->assign('pagestr',$pagestr);
        $this->assign('comments',$comments);
        $this->display('commentIndex.html');

    }

    //删除
	public function delete(){
		//接收数据
		$id = (int)$_GET['id'];

		//调用模型删除
		$c = new \admin\model\CommentModel();
		if($c->deleteById($id)){
			$this->success('评论删除成功！','index');
		}else{
			$this->error('评论删除失败！','index');
		}
	}

    
}