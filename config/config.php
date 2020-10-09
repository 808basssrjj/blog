<?php


//配置文件
//return在函数中代表返回值，将函数内容（结果）返回给函数调用出；在文件中使用return，代表将return后跟的内容返回给文件包含处
return array(
	//数据库配置
    'database'=> array(
        'type' => 'mysql',		//数据库产品
    	'host' => 'localhost',
        'port' => '3306',
        'user' => 'root',
        'pass' => 'root',
        'charset' => 'utf8',
        'dbname'  => 'blog',
        'prefix'  => 'b_'			//表前缀
    ),

    //驱动信息
    'drivers' => array(),

	//其他配置
	'system' => array(
		'error_reporting' => E_ALL,   //错误级别控制，默认显示所有错误
		'displary_errors' => 1,		  //错误显示控制，1表示显示错误，0表示隐藏错误
		),

);