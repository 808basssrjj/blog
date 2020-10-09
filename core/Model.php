<?php

//公共模型
namespace core;


class Model{
	//属性：保存Dao对象
	protected $dao;
	//保存当前表的所有字段：额外多出一个主键字段
	protected $fields;

	//实例化
	public function __construct(){
		//加载配置文件
		global $config;
		
		//实例化DAO
		$this->dao = new Dao($config['database'],$config['drivers']);

		//初始化字段信息
		$this->getFields();
	}

	//写方法
	protected function exec(string $sql){		    //这个是在子类模型中调用
	    return $this->dao->dao_exec($sql);
	}
	//获取ID
	public function getLastId(){			//这个是可能控制器调用
	    return $this->dao->dao_insert_id();
	}

	//读方法
	protected function query(string $sql,$all = false){
	    return $this->dao->dao_query($sql,$all);
	}

	//构造全表名
	protected function getTable(string $table = ''){
		//构造前缀：$config
		global $config;

		//确定表名字
		$table = empty($table) ? $this->table : $table;

		//构造全名
		return $config['database']['prefix'] . $table;
	}

	//获取全部数据：当前表
	protected function getAll(){
		//组织SQL
		$sql = "select * from {$this->getTable()}";

		//执行
		return $this->query($sql,true);		
	}

	//获取表字段
	private function getFields(){
		//通过desc来获取表字段信息
		$sql = "desc {$this->getTable()}";

		//执行
		$rows = $this->query($sql,true);

		//循环遍历
		foreach($rows as $row){
			//保存到$this->fields属性
			$this->fields[] = $row['Field'];

			//确定主键
			if($row['Key'] == 'PRI'){
				$this->fields['Key'] = $row['Field'];
			}
		}
	}

	//通过主键获取记录
	public function getById($id){
		//判定：当前表是否有主键
		if(!isset($this->fields['Key'])) return false;

		//组织SQL
		$sql = "select * from {$this->getTable()} where {$this->fields['Key']} = '{$id}'";

		//执行
		return $this->query($sql);
	}

	//通过主键获取记录
	public function deleteById($id){
		//判断 是否有主键
		if(!isset($this->fields['Key'])) return false;

		$sql="delete from {$this->getTable()} where {$this->fields['Key']} = '{$id}'";
		//执行
		return $this->exec($sql);
		
	}
	
		/*
	* 有主键的自动更新
	* @param1 int $id，主键值
	* @param2 array $data，要更新的数组，里面必须带主键字段
	* @return mixed ，成功返回受影响的行数（可能是0行），失败（错误）返回false
	*/
	public function autoUpdate($id,$data){  
		//确定where条件，注意where两侧的空格
		$where= " where {$this->fields['Key']} = '{$id}' ";

		$sql="update {$this->getTable()} set ";
		foreach($data as $k =>$v){
			$sql .= $k .'=" ' .$v .' ",';
		}

		//去除最后多余的逗号“,”，构造完整SQL语句
		$sql = trim($sql,',') . $where;
		// echo $sql;
		// exit;
		//执行SQL
		return $this->exec($sql);
	}

	//自动新增
	public function autoInsert($data){
		//构建字段列表和值列表
		$keys = $values = '';

		//通过当前属性fields保存的所有字段来获取data中对应的数据
		foreach($this->fields as $k => $v){
			//k代表索引，v代表字段名
			
			//去除主键
			if($k == 'Key') continue;

			//判定当前的字段在data中是否存在：存在取出数据，不存在不要
			if(array_key_exists($v,$data)){
				//存在：取出数据
				$keys .= $v . ',';
				$values .= "'" . $data[$v] . "',";
			}
		}

		//去除右边多出来的逗号
		$keys = rtrim($keys,',');
		$values = rtrim($values,',');

		//组织完整SQL指令
		$sql = "insert into {$this->getTable()} ({$keys}) values({$values})";

		//执行SQL指令
		return $this->exec($sql);

	}
}