<?php
namespace admin\controller;
use \core\Controller;

class CategoryController extends Controller{

    //显示所有分类
    public function index(){

        //获取所有无限极分类信息
        $c =new \admin\model\CategoryModel();
        $categories=$c->getAllCategories();

        //保存到session :无限极分类比较占cpu
        $_SESSION['categories']=$categories;

        //获取对应分类下对应的文章数 :博文表article
        $a = new \admin\model\ArticleModel();
        $c_count=$a->getAtilcleCountsByCategory();

        $this->assign('c_count',$c_count);
        $this->display('categoryIndex.html');
    }

    //新增分类:显示表单信息
    public function add(){
        //表单中要显示分类,判定是否存在
        if(!isset($_SESSION['categrries'])){
            
            //获取所有无限极分类信息
            $c =new \admin\model\CategoryModel();
            $categories=$c->getAllCategories();

            //保存到session :无限极分类比较占cpu
            $_SESSION['categories']=$categories;
        }

        $this->display('categoryAdd.html');
    }

    //新增分类:数据入库
    public function insert(){
        //1.接收数据
        $c_name=trim($_POST['c_name']);
        $c_parent_id=(int)$_POST['c_parent_id'];
        $c_sort=trim($_POST['c_sort']);

        //2.合法性验证:分类名字不能为空，
        if(empty($c_name)){
            $this->error('分类名字不能为空!','add');
        }

        //3.合法性验证:排序必须为正整数
        if(!is_numeric($c_sort) || (int)$c_sort != $c_sort || $c_sort<0 || $c_sort>PHP_INT_MAX){
            $this->error('排序必须为一个正整数!','add');
        }

        //4.合理性验证：当前父分类下不应该有同名的分类，应该调用模型验证当前指定的父分类下是否有同名分类
        $c=new \admin\model\CategoryModel();
        if($c->checkCategoryName($c_parent_id,$c_name)){
            //查到数据：说明已经存在，重新来过
            $this->error('当前分类名字：' . $c_name . ' 在所选父分类下已经存在！','add');
        }

        //5.数据入库
        if($c->insertCategory($c_parent_id,$c_name,$c_sort)){
            //插入成功
            $this->success('分类：' . $c_name . ' 新增成功！','index');
        }else{
            //插入失败
            $this->error('分类：' . $c_name . ' 新增失败！','add');
        }
    }

    //删除分类
    public function delete(){
        //接受数据
        $id=(int)$_GET['id'];

        //判断是否可以删除 有子分类不能删除
        $c=new \admin\model\CategoryModel();
        if($c->getSon($id)){
            $this->error('当前分类有子分类,不能删除','index');
        }

        //验证是否可删除：是否已经拥有博文（后续博文实现后完成）
        $a = new \admin\model\ArticleModel();
        if($a->checkArticleByCategory($id)){
            $this->error('当前分类下有博文关联，不能删除','index');
        }


        //删除分类
        if($c->deleteById($id)){
            $this->success('分类删除成功！','index');
        }else{
            $this->error('分类删除失败！','index');
        }       
    }

    //编辑分类:显示
    public function edit(){
        //接收数据
        $id = (int)$_GET['id'];

        //有效性验证：判断当前分类ID是否在session中存在：不存在肯定无效
        if(!array_key_exists($id,$_SESSION['categories'])){
            //不存在
            $this->error('当前要编辑的分类不存在！','index');
        }

        //bug修改 去除部分数据 (自己及子分类)
        $c = new \admin\model\CategoryModel();
        $categories = $c->noLimitCategory($_SESSION['categories'],0,0,$id);

        //分类id给模板
        $this->assign('categories',$categories);
        $this->assign('id',$id);
        $this->display('categoryEdit.html');
    }

    //编辑分类:更新数据入库
    public function update(){
        //接收数据
        $id = (int)$_POST['id'];
        $data['c_name'] = trim($_POST['c_name']);
        $data['c_parent_id'] = (int)$_POST['c_parent_id'];
        $data['c_sort'] = trim($_POST['c_sort']);

        //合法性验证:分类名字不能为空，
        if(empty($data['c_name'])){
            $this->back('分类名字不能为空!');
        }

        //合法性验证:排序必须为正整数
        if(!is_numeric($data['c_sort']) || (int)$data['c_sort'] != $data['c_sort'] || $data['c_sort']<0 || $data['c_sort']>PHP_INT_MAX){
            $this->back('排序必须为一个正整数!');
        }

        //有效性验证：确保不会在同一父类下出现同名分类
        $c=new \admin\model\CategoryModel();
        $cat = $c->checkCategoryName((int)$data['c_parent_id'],$data['c_name']);
        if($cat &&$cat['id']!=$id){
            //查到同名分类，且分类的id是自己，说明重名了
            $this->error('当前分类名字在所选父分类下已经存在！','index');
        }

        
        //通过session中对应的分类判定数组是否有不同的数据（用户有没有更新）:$data中有但后面数组不同，就保留
        $data=array_diff_assoc($data,$_SESSION['categories'][$id]);
        if(empty($data)){
            //没有不不同的数据
            $this->error('没有要更新的内容！','index');
        }

        //更新入库
        if($c->autoUpdate($id,$data)){
            //更新成功
            $this->success('更新成功！','index');
        }else{
            //更新失败
            $this->error('更新失败！','index');
        }
    }

}