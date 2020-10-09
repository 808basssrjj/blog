<?php
namespace admin\model;
use \core\Model;

class ArticleModel extends Model{
    //属性 保存表明（不带前缀）
    protected $table='article';


    /* 
    * 获取博文基本信息
    * @param1 array $cond = array()，查询条件数组，字段名为下标，条件包含标题、分类、状态、置顶和作者
    * @param2 int $pagecount = 5，每次获取的数量
    * @param3 int $page = 1，分页页码
    */
    public function getArticleInfo(array $cond = array(),int $pagecount = 5,int $page = 1){
        //基础条件:文章没有被删除
        $where = " where a_is_delete=0";

        //条件组织
        foreach($cond as $k => $v){
            //k代表字段名 v代表条件值
            switch($k){
                case 'a_title':
                    $where .= " and a_title like '%{$v}%' ";
                        break;
                    case 'c_id':
                    case 'a_status':
                    case 'a_toped':
                    case 'u_id':
                        //都是使用=符号进行条件筛选，可以统一用
                        $where .= " and {$k} = {$v}";
                        break;
            }
        }

        //计算分页
        $offset = ($page-1) * $pagecount;

        //构造完整sql
        $sql = "select id,a_title,a_author,a_time,a_status,c_id,u_id 
        from {$this->getTable()} {$where} order by a_time desc limit {$offset},{$pagecount}";
        //echo $sql; exit;
        return $this->query($sql,true);
    }

    public function getSearchCounts($cond = array()){
        //基础条件:文章没有被删除
        $where = " where a_is_delete=0";

        //条件组织
        foreach($cond as $k => $v){
            //k代表字段名 v代表条件值
            switch($k){
                case 'a_title':
                    $where .= " and a_title like '%{$v}%' ";
                        break;
                    case 'c_id':
                    case 'a_status':
                    case 'a_toped':
                    case 'u_id':
                        //都是使用=符号进行条件筛选，可以统一用
                        $where .= " and {$k} = {$v}";
                        break;
            }
        }

        //组织sql
        $sql = "select count(*) c from {$this->getTable()} {$where}";

        //取出结果 数组
        $res = $this->query($sql);

        return $res['c'] ?? 0;


    }

    //根据分类获取博文数量：分类id作为数组下标
    public function getAtilcleCountsByCategory(){
        $sql = "select c_id,count(*) c from {$this->getTable()} where a_is_delete = 0 group by c_id";
        //echo $sql; exit;
        $res = $this->query($sql,true);
        $list=array();
        foreach($res as $value){
            $list[$value['c_id']]=$value['c'];
        }
        return $list;

    }

    //获取分类下可能存在的结果
    public function checkArticleByCategory($c_id){
        $sql = "select id from {$this->getTable()} where c_id = {$c_id} limit 1";
		return $this->query($sql);
    }
}