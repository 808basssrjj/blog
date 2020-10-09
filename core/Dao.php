<?php

//命名空间
namespace core;

//引入全局空间类：PDO三类
use \PDO,\PDOStatement,\PDOException;

//创建Dao类
class Dao{
	//属性
	private $pdo;
	private $fetch_mode;

	//构造方法
	public function __construct($info = array(),$drivers = array()){
		$type = $info['type'] ?? 'mysql';
		$host = $info['host'] ?? 'localhost';
		$port = $info['port'] ?? '3306';
		$user = $info['user'] ?? 'root';
		$pass = $info['pass'] ?? 'root';
		$dbname = $info['dbname'] ?? 'blog';
		$charset = $info['charset'] ?? 'utf8';
		$this->fetch_mode = $info['fetch_mode'] ?? PDO::FETCH_ASSOC;

		//驱动控制：异常模式处理
    	$drivers[PDO::ATTR_ERRMODE] = $drivers[PDO::ATTR_ERRMODE] ?? PDO::ERRMODE_EXCEPTION;


    	//实例化PDO对象
    	try{
    		$this->pdo = @new PDO($type . ':host=' . $host . ';port=' . $port . ';dbname=' . $dbname,$user,$pass,$drivers);
    	}catch(PDOException $e){
    		echo '连接错误！<br/>';
	        echo '错误文件为：' . $e->getFile() . '<br/>';
	        echo '错误行号为：' . $e->getLine() . '<br/>';
	        echo '错误描述为：' . $e->getMessage();
	        die();
    	}

    	//设定字符集
    	try{
    		$this->pdo->exec("set names {$charset}");
    	}catch(PDOException $e){
    		/*echo 'SQL执行错误！<br/>';
	        echo '错误文件为：' . $e->getFile() . '<br/>';
	        echo '错误行号为：' . $e->getLine() . '<br/>';
	        echo '错误描述为：' . $e->getMessage();
	        die();*/

	        //调用异常处理方法
	        $this->dao_exception($e);
    	}
	}

	//SQL执行错误的异常处理
	private function dao_exception(PDOException $e){
		echo 'SQL执行错误！<br/>';
	    echo '错误文件为：' . $e->getFile() . '<br/>';
	    echo '错误行号为：' . $e->getLine() . '<br/>';
	    echo '错误描述为：' . $e->getMessage();
	    die();
	}

	//写方法
	public function dao_exec($sql){
		//执行
		try{
			return $this->pdo->exec($sql);
		}catch(PDOException $e){
			$this->dao_exception($e);
		}
	}

	//获取自增长ID
	public function dao_insert_id(){
		return $this->pdo->lastInsertId();
	}

	//读方法：二合一（一条和多条，默认一条）
	public function dao_query($sql,$all = false){
		try{
			$stmt = $this->pdo->query($sql);

			//设置fetch_mode
			$stmt->setFetchMode($this->fetch_mode);

			//解析数据
			if(!$all){
				//考虑到可能查不到有效结果，要进行异常处理
				return $stmt->fetch();
			}else{
				return $stmt->fetchAll();		
			}
			
		}catch(PDOException $e){
			$this->dao_exception($e);
		}
	}
}
