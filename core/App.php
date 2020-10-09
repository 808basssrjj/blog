<?php

//增加命名空间
namespace core;

//安全判定
if(!defined('ACCESS')){
	//非法访问
	header('location:../public/index.php');
	exit;	//header不会终止后序代码执行
}


//初始化类
class App{
	//入口方法
	public static function start(){
		//目录常量设置
		self::set_path();
		//配置文件
		self::set_config();
		//错误处理
		self::set_error();
		//解析URL
		self::set_url();
		//自动加载
		self::set_autoload();
		//分发控制器
		self::set_dispatch();
		
	}

	//设置目录常量
	private static function set_path(){
	    //定义不同路径常量：核心目录、App目录、控制器目录、模型目录、视图目录、扩展目录
	    define('CORE_PATH',		ROOT_PATH . 'core/');
	    define('APP_PATH',		ROOT_PATH . 'app/');
	    define('HOME_PATH',		APP_PATH . 'home/');
	    define('ADMIN_PATH',	APP_PATH . 'admin/');
	    define('ADMIN_CONT',	ADMIN_PATH . 'controller/');
	    define('ADMIN_MODEL',	ADMIN_PATH . 'model/');
	    define('ADMIN_VIEW',	ADMIN_PATH . 'view/');			//如果使用Smarty加载，意义不大
	    define('HOME_CONT',		HOME_PATH . 'controller/');
	    define('HOME_MODEL',	HOME_PATH . 'model/');
	    define('HOME_VIEW',		HOME_PATH . 'view/');
	    define('VENDOR_PATH',	ROOT_PATH . 'vendor/');
		define('CONFIG_PATH',	ROOT_PATH . 'config/');
	    define('UPLOAD_PATH',	ROOT_PATH . 'public/uploads/');
	    define('URL','http://www.blog.com/');			
	    //如果框架设计够大够全，还有一些目录常量需要配置
	}

	//增加错误控制方法
	private static function set_error(){
		//拿配置文件读取的全局变量
		global $config;
		// var_dump($config);
	    //错误类型和错误处理方式
	    @ini_set('error_reporting',$global['system']['error_reporting']);	//E_ALL为系统常量，表示所有错误
	    @ini_set('displary_errors',$global['system']['displary_errors']);		//显示错误信息
	}

	//增加配置文件
	private static function set_config(){
		//设定全局变量保存配置文件
		global $config;
		//包含配置文件
		$config = include CONFIG_PATH . 'config.php';
	}

	//解析URL
	private static function set_url(){
		//取出平台信息（p），控制器信息（c）和具体方法信息（a）
		$p = $_REQUEST['p'] ?? 'home';	//默认访问前台
		$c = $_REQUEST['c'] ?? 'Index';	//默认IndexController
		$a = $_REQUEST['a'] ?? 'index';

		//考虑到以上信息可能会在后序用到（其他类中）：定义成常量
		define('P',$p);
		define('C',$c);
		define('A',$a);		
	}

	//自动加载方法（自定义方法）
	private static function set_autoload_function($class){
		//$class代表内存中不存在的类（如果项目有命名空间，那么此时带着空间路径）\home\controller\IndexController
		//取出类名
		$class = basename($class);

		//判定对应文件夹是否存在：存在包含
		$core_file = CORE_PATH . $class . '.php';
		if(file_exists($core_file)) include $core_file;

		//判定控制器是否存在：包括前后台的
		$cont_file = APP_PATH . P . '/controller/' . $class . '.php';
		if(file_exists($cont_file)) include $cont_file;

		//判定模型是否存在
		$model_file = APP_PATH . P . '/model/' . $class . '.php';
		if(file_exists($model_file)) include $model_file;

		//插件加载
		$vendor_file = VENDOR_PATH . $class . '.php';
		if(file_exists($vendor_file)) include $vendor_file;
	}

	//注册自动加载
	private static function set_autoload(){
		//利用spl_autoload_register进行注册
		spl_autoload_register(array(__CLASS__,'set_autoload_function'));
	}


	//分发控制器
	private static function set_dispatch(){
		//找打前后台、控制器、方法：\home\controller\IndexController;
		$p = P;
		$c = C;
		$a = A;

		//组织成合适的空间元素
		$controller = "\\{$p}\\controller\\{$c}Controller";
		$c = new $controller();								//已经拿到对象：调用方法
		//var_dump($c);
		//调用方法：最终分发
		$c->$a();											//可变方法
		
	}
}
