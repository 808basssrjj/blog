<?php

namespace home\model;
use \core\Model;


class ArticleModel extends Model{
	//增加表名
    protected $table = 'article';
    
    /* 
    * 获取博文详细信息
    * @param1 array $cond = array()，查询条件数组，字段名为下标，条件包含标题、分类
    * @param2 int $pagecount = 5，每次获取的数量
    * @param3 int $page = 1，分页页码
    */
    public function getAllArticles($cond=array(),$pagecount = 5,$page=1){
        //计算分页信息
        $offset=($page-1) * $pagecount;

        //构造基础条件where：所有查询出来的结果应该都是未“删除”的
        $where = ' where a_is_delete = 0 and a_status = 2';

        //组织条件
        if($cond['a_title']) $where.= " and a_title like '%{$cond['a_title']}%' ";
        if($cond['c_id']) $where.= " and c_id={$cond['c_id']}";

        //组织完整sql
        //$sql = "select * from {$this->getTable()} {$where} limit {$offset},{$pagecount}";
        $sql = "select a.*,c.c_count from {$this->getTable()} 
        a left join(select a_id,count(*) c_count from {$this->getTable('comment')} 
        group by a_id) c on a.id=c.a_id {$where} limit {$offset},{$pagecount}";

       
        //echo $sql; exit;
        return $this->query($sql,true);
    }

    //获取分类下对应的博文数量:分类id作为下标
    public function getCountsByCategory(){
        //组织SQL并执行
        $sql = "select c_id,count(*) c from {$this->getTable()} where a_is_delete = 0 and a_status = 2 group by c_id";
        //执行
        $res = $this->query($sql,true);
        //array(0=>array(1,5),1=>array(2,2))

        $list = array();
        foreach($res as $v){
            $list[$v['c_id']] = $v['c'];
            //array(1=>5,1=>2)
        }

        return $list;
    }

    //获取最新博文 3条
    public function getNews($limit=3){
        //组织SQL：获取id、标题、缩略图
        $sql = "select id,a_title,a_img_thumb from {$this->getTable()} order by a_time desc limit {$limit}";
        return $this->query($sql,true);
    }


    //根据条件获取记录数
    public function getCounts(){
         //构造基础条件where：所有查询出来的结果应该都是未“删除”的
         $where = ' where a_is_delete = 0 and a_status = 2';

         //组织条件
         if($cond['a_title']) $where.= " and a_title like '%{$cond['a_title']}%' ";
         if($cond['c_id']) $where.= " and c_id={$cond['c_id']}";

         //sql
         $sql = "select count(*) c from {$this->getTable()} {$where}" ;
         $res = $this->query($sql);
         return $res['c'] ?? 0;

    }

    
}