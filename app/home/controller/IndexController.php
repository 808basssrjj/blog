<?php

//命名空间
namespace home\controller;
//引入公共控制器
use \core\Controller;

class IndexController extends Controller{
    //默认方法
    public function index(){
        //接收索引数据
        $cond =array();
        if(isset($_GET['c_id']) && $_GET['c_id'] != 0) $cond['c_id']=(int)$_GET['c_id'];
        if(isset($_REQUEST['a_title']) && !empty(trim($_REQUEST['a_title']))) $cond['a_title']=trim($_REQUEST['a_title']);

        //在最开始接收分页数据
        $page = $_REQUEST['page'] ?? 1;
        //读取分页量
        global $config;
        $pagecount = $config['home']['article_pagecount'] ?? 5;


        //获取所有无限极分类信息
        $c =new \home\model\CategoryModel();
        $categories=$c->getAllCategories();

        //保存到session :无限极分类比较占cpu
        @session_start();
        $_SESSION['categories']=$categories;
     
        //获取所有博文 分页显示
        $a = new \home\model\ArticleModel();
        $article = $a->getAllArticles($cond,$pagecount,$page);

        //获取满足条件的记录总数
        $counts= $a->getCounts($cond);

        //获取分类下对于的博文属性
        $cat_counts = $a->getCountsByCategory();
        
        //获取最新博文
        $news = $a->getNews();
       
        //调用分页类
        $pagestr = \vendor\Page::clickPage(URL . 'index.php',$counts,$pagecount,$page,$cond);

        //分配给模板
        $this->assign('pagestr',$pagestr);
        $this->assign('cond',$cond);
        $this->assign('news',$news);
        $this->assign('cat_counts',$cat_counts);
        $this->assign('article',$article);
       	$this->display('blogShowList.html');
    }

      //查看博文明细
      public function detail(){
        $id=(int)$_GET['id'];

        //获取文章
        $a = new \home\model\ArticleModel();
        $article = $a->getById($id);
        
        //开启session
        @session_start();
        if(!isset($_SESSION['categroies'])){
            //获取所有分类信息
            $c =new \home\model\CategoryModel();
            $categories=$c->getAllCategories();

            //保存到session 
            $_SESSION['categories']=$categories;
        }

        //获取全评论
        $c = new \home\model\CommentModel();
        $comments = $c->getCommentsByArticle($id);
        
        //分配数据
        $this->assign('comments',$comments);
        $this->assign('article',$article);
        $this->display('blogShow.html');
    }
}