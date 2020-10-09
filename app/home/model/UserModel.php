<?php

//用户表的模型
namespace home\model;
use \core\Model;

class UserModel extends Model{
    //属性 保存表明（不带前缀）
    protected $table='user';


	//验证用户名是否存在
	public function checkUsername($username){
		//防止sql注入
		$username = addslashes($username);

		$sql = "select * from {$this->getTable()} where u_username = '{$username}'";

		//2.执行SQL
		//echo $sql;exit;
		return $this->query($sql);
	}

	

}