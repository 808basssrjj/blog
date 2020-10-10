<?php

//文件上传类
namespace vendor;

class Uploader{

    //静态属性：保存允许上传的类型MIME类型，默认为jpg图片
    private static $types=array('image/jpg','image/jpeg','image/pjpeg');

    //方法设定类型
    public static function setType(array $types){
        if(!empty($types)) self::$types=$types;
    }

   

    /*
    * 上传单个文件
    * @param1 array $file，要上传的单个文件信息
    * @param2 string $path，存储路径
    * @param3 int $max = 2000000，限定大小，默认2M
    * @return mixed，成功返回新的文件名字，失败返回false
    */
     //静态属性：保存可能出现的错误信息
    public static $error;
    public static function uploadOne(array $file,string $path,int $max = 2000000){
        
        //判定文件有效性：是数组，而且有5个上传文件要素
        if(!isset($file['error']) || count($file) != 5){
			self::$error = '无效的上传文件！';
			return false;
		}

        //判定存储路径是否存在
        if(!is_dir($path)){
            self::$error = '文件存储路径不存在';
            return false;
        }

        //判定文件是否正确上传
        switch($file['error']){
            case 1:
            case 2:
                self::$error = '文件超过服务器允许大小！';
                return false;
            case 3:
                self::$error = '文件只有部分被上传！';
                return false;
            case 4:
                self::$error = '没有选中要上传的文件！';
                return false;
            case 6:
            case 7:
                self::$error = '服务器错误！';
                return false;
        }

        //判定文件类型是否允许上传
        if(!in_array($file['type'],self::$types)){
            self::$error = '当前文件类型不允许上传！';
            return false;
        }

        //判定文件是否超出当前用户允许大小
        if($file['size'] > $max){
            self::$error = '当前文件超过：' . (string)($max/1000000) . 'M';
            return false;
        }

        //获取新名字
        $filename = self::getRandomName($file['name']);

       //移动上传的临时文件到指定目录
		if(move_uploaded_file($file['tmp_name'],$path . '/' . $filename)){
			//成功
			return $filename;
		}else{
			//失败
			self::$error = '文件移动失败！';
			return false;
		}

    }
    

    //根据原有名字生成新名字（后缀不变）：名字有当前时间类型 + YmdHis + 随机6位大写字母组成
    public static function getRandomName(string $filename){
        //获取后缀
        $ext = strrchr($filename,'.');	//带.
        
        //生成随机名字
        $newname = $prefix . date('YmdHis');	//image前缀 + 日期时间部分
        
        //增加随机字符（6位大写字母）
        for($i = 0;$i < 6;$i++){
            $newname .= chr(mt_rand(65,90));
        }

        //返回完整名字
        return $newname . $ext;
    }
}