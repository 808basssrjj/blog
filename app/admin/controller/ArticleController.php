<?php

#博文控制器
namespace admin\controller;
use \core\Controller;

class ArticleController extends Controller{
    //添加博客：显示博客表单
    public function add(){

        //表单中要显示分类,判定是否存在
        if(!isset($_SESSION['categrries'])){
            
            //获取所有无限极分类信息
            $c =new \admin\model\CategoryModel();
            $categories=$c->getAllCategories();

            //保存到session :无限极分类比较占cpu
            $_SESSION['categories']=$categories;
        }
        
        //加载博客模板
        $this->display('articleAdd.html');
    }

    //添加博文 :数据入库
    public function insert(){
        $data=$_POST;

        //数据合法性验证：标题、内容不能为空，分类ID必须存在
        if(empty(trim($data['a_title'])) || empty(trim($data['a_content']))){
            $this->error('标题或内容不能为空!','add');
        }
        if(!array_key_exists($data['c_id'],$_SESSION['categories'])){
            $this->error('当前分类不存在!','add');
        }

        //补充必要数据：用户id，用户名、录入时间
        $data['u_id'] = $_SESSION['user']['id'];
        $data['a_author'] = $_SESSION['user']['u_username'];
        $data['a_time'] = time();

        //文件上传和缩略图制作
        if($a_img = \vendor\Uploader::uploadOne($_FILES['a_img'],UPLOAD_PATH)){
			//图片上传成功
            $data['a_img'] = $a_img;

            //成功 制作缩略图
            $a_img_thumb = \vendor\Image::makeThumb(UPLOAD_PATH.$a_img,UPLOAD_PATH);
            if($a_img_thumb) $data['a_img_thumb']=$a_img_thumb;
        }

        //数据入库
        $c=new \admin\model\ArticleModel();

        if($c->autoInsert($data)){
            //如果文件上传失败，给出提示
            if(!$a_img) $this->success('博文新增成功！但图片上传失败 失败原因:'. \vendor\Uploader::$error,'index');

            //图片上传成功 但缩略图制作失败 给出提示
            if($a_img && !$a_img_thumb) $this->success('博文新增成功！但缩略图制作失败 失败原因:'. \vendor\Image::$error,'index');

            //插入成功
            $this->success('博文：' . $data['a_title'] . ' 新增成功！','index');
        }else{
            //插入失败 干掉可能上传的图片
            @unlink(UPLOAD_PATH . $a_img); //unlink()删除文件
            $this->error('博文：' . $$data['a_title'] . ' 新增失败！','add');
        }
    }  

    //博文显示
    public function index(){
        //接收可能存在的页码
        $page  = $_REQUEST['page'] ?? 1;

        //接收分页数据:每页显示两
        global $config;
        $pagecount = $config['admin']['article_pagecount'] ?? 5; 

        //接收可能存在索引条件：所有代码之前，利用数组接收
        $cond = array();	

        //判定接收：判定有数据且数据有效，才做条件
        if(isset($_REQUEST['a_title']) && !empty(trim($_REQUEST['a_title']))) $cond['a_title'] = trim($_REQUEST['a_title']);
        if(isset($_REQUEST['c_id']) && (int)$_REQUEST['c_id'] != 0) $cond['c_id'] = (int)$_REQUEST['c_id'];
        if(isset($_REQUEST['a_status']) && (int)$_REQUEST['a_status'] != 0) $cond['a_status'] = (int)$_REQUEST['a_status'];
        if(isset($_REQUEST['a_toped']) && (int)$_REQUEST['a_toped'] != 0) $cond['a_toped'] = (int)$_REQUEST['a_toped'];

        //用户条件筛选：如果普通用户，只能看到自己的
        if(!$_SESSION['user']['u_is_admin']) $cond['u_id'] = $_SESSION['user']['id']; 


        //表单中要显示分类,判定是否存在
        if(!isset($_SESSION['categrries'])){
            
            //获取所有无限极分类信息
            $c =new \admin\model\CategoryModel();
            $categories=$c->getAllCategories();

            //保存到session :无限极分类比较占cpu
            $_SESSION['categories']=$categories;
        }

        $a =new \admin\model\ArticleModel();
        $articles=$a->getArticleInfo($cond,$pagecount,$page);

        //获取满足条件的记录总数
        $counts= $a->getSearchCounts($cond);

        //增加分页链接条件
        $cond['a'] = A;
        $cond['c'] = C;
        $cond['p'] = P;

        //调用分页类
        $pagestr = \vendor\Page::clickPage(URL . 'index.php',$counts,$pagecount,$page,$cond);

        //显示模板
        $this->assign('pagestr',$pagestr);
        $this->assign('cond',$cond);
        $this->assign('articles',$articles);
        $this->display('articleIndex.html');
    }

    //删除博文
    public function delete(){
        //接受数据
        $id=(int)$_GET['id'];

        //调用模型删除数据
        $a= new \admin\model\ArticleModel();
        if($a->deleteById($id)){
            $this->success('删除成功!','index');
        }else{
            $this->error('删除失败!','index');
        }
    }

    //编辑博文:显示内容
    public function edit(){
        //接受数据
        $id=(int)$_GET['id'];

         //调用模型删除数据
        $a= new \admin\model\ArticleModel();
        $art=$a->getById($id);
        //var_dump($article);

        if(!$art){
            $this->error('当前博文不存在','index');
        }


       //表单中要显示分类,判定是否存在
       if(!isset($_SESSION['categrries'])){
            
            //获取所有无限极分类信息
            $c =new \admin\model\CategoryModel();
            $categories=$c->getAllCategories();

            //保存到session :无限极分类比较占cpu
            $_SESSION['categories']=$categories;
        }

        $this->assign('art',$art);
        $this->display('articleEdit.html');
    }

    //编辑博文:数据入库
    public function update(){
         //接收数据
        $id = (int)$_POST['id'];
        $data['a_title'] = trim($_POST['a_title']);
        $data['c_id']    = (int)$_POST['c_id'];
        $data['a_status']= (int)$_POST['a_status'];
        $data['a_toped'] = (int)$_POST['a_toped'];
        $data['a_content'] = trim($_POST['a_content']);
        // echo $data['c_id'];
        // echo $data['a_status'];
        //数据合法性判定
        if(empty($data['a_title']) || empty($data['a_content'])){
            //此时应该回退到上级编辑界面：增加公共方法back()
            $this->back('博文的标题和内容都不能为空！');
        }



        $a= new \admin\model\ArticleModel();
        $art =$a->getById($id);

        //通过session中对应的分类判定数组是否有不同的数据（用户有没有更新）:$data中有但后面数组不同，就保留
        $data = array_diff_assoc($data,$art);
        if(empty($data)){
            //没有不不同的数据
            $this->error('没有要更新的内容！','index');
        }

        //更新入库
        if($a->autoUpdate($id,$data)){
            //更新成功
            $this->success('更新成功！','index');
        }else{
            //更新失败
            $this->error('更新失败！','index');
        }
    }

}
