<?php

//用户表的模型
namespace admin\model;
use \core\Model;

class UserModel extends Model{
    //属性 保存表明（不带前缀）
    protected $table='user';

    //通过用户名获取用户信息
    public function getUserByUsername($username){
		//防止SQL注入：通过特殊符号改变SQL指令
		$username = addslashes($username);

		//1.组织SQL指令：获取用户信息
		$sql = "select * from {$this->getTable()} where u_username = '{$username}'";

		//2.执行SQL
		return $this->query($sql);
	}

	//获取用户数量
	public function getCounts(){
		//1.组织SQL
		$sql="select count(*) as c from {$this->getTable()}";

		//2.执行SQL
		$res= $this->query($sql);

		//返回结果
		return $res['c'] ?? 0;
	}

	//验证用户名是否存在
	public function checkUsername($username){

		$sql = "select id from {$this->getTable()} where u_username = '{$username}'";

		//2.执行SQL
		return $this->query($sql);
	}

	/*
	* 获取所有用户信息：根据分页获取
	* @param1 int $pagecount = 5,每页获取数据
	* @param2 int $page = 1，当前页码
	* @return mixed，成功返回二维数组，失败返回false
	*/
	public function getAllUsers($pagecount = 5,$page = 1){
		//分析分页数据
		$offset = ($page - 1) * $pagecount;
		//组织SQL并执行
		$sql = "select id,u_username,u_is_admin,u_reg_time from {$this->getTable()} order by u_reg_time desc limit {$offset},{$pagecount}";
		
		
		return $this->query($sql,true);
	}

	

}