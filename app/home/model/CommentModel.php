<?php
namespace home\model;
use \core\Model;

class CommentModel extends Model{
    //属性
    protected $table = 'comment';

    //获取博文对应的所有评论
    public function getCommentsByArticle($a_id){
         //组织SQL
        $sql = "select c.*,u.u_username from {$this->getTable()}
         c left join {$this->getTable('user')} u on c.u_id = u.id where c.a_id = {$a_id} order by c.c_time desc";
    
        //执行
        return $this->query($sql,true);
    }
}