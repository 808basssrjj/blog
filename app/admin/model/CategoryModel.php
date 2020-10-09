<?php
namespace admin\model;
use \core\Model;

class CategoryModel extends Model{
    //属性 保存表明（不带前缀）
    protected $table='category';

    //获取所有分类信息
    public function getAllCategories(){
        $sql="select * from {$this->getTable()} order by c_sort desc";

        $categoties= $this->query($sql,true);
        return $this->noLimitCategory($categoties);
    }

    
    /*
    * 无限极分类
    * @param1 array $categories，一个包含无限分类的数组
    * @param2 int $parent_id = 0，要确定从哪层开始寻找分类，默认为顶层，即找出所有分类
    * @param3 int $level = 0,当前得到的分类的有效层级，因为默认从顶级开始查，所以顶级的级别是0
    * @return array $list，分好类，同时每个分类添加了level元素的二维数组
    */
    
    public function noLimitCategory($categoties,$parent_id=0,$level=0,$stop=0){
        //因为寻找每次只能找一层：所以意味着找下层就要调用自己，应用递归，而跨方法保存数据需要使用静态变量
        static $list=array();

        //便利数组,获得满足要求的结果
        foreach($categoties as $cat){

            //2.逻辑修改：如果当前分类是禁止的，那么循环重新开始
            if($cat['id'] == $stop) continue;

            //匹配条件
            if($cat['c_parent_id'] == $parent_id){
                //增加level信息
                $cat['level']=$level;

                //当前需要的分类
                $list[$cat['id']]=$cat;

                //当前分类可能有子分类
                $this->noLimitCategory($categoties,$cat['id'],$level+1,$stop);
            }
        }
        //返回结果
        return $list;
    }

    //查询指定父分类下是否有同名分类
    public function checkCategoryName($parent_id,$name){
        $sql= "select id from {$this->getTable()} where c_parent_id={$parent_id} and c_name='{$name}'";
        return $this->query($sql);
    }

    //分类入库
    public  function insertCategory($parent_id,$name,$sort){
        $sql="insert into {$this->getTable()} values (null,'{$name}',{$sort},{$parent_id})";
        return$this->exec($sql);
    }

    //获取子分类
    public function getSon($id){
        $sql="select id from {$this->getTable()} where c_parent_id={$id}";
        return $this->query($sql);
    }

   
}
