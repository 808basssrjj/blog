<?php
namespace vendor;

//验证码类
class Captcha{
    #生成验证码
    /*
    * @param1 int $width = 450，验证码图片默认宽度
    * @param2 int $height = 65，验证码图片默认高度
    * @param3 int $length = 4，验证码默认字符数
    * @param4 string $fonts = ''，验证码字体，默认为空（内部使用默认字体）
    */
    public static function getCaptcha($width = 450,$height = 65,$length = 4,$fonts = ''){

        //1.1判断字体资源
        if(empty($fonts)) $fonts='verdana.ttf';

        //1.2确定路径
        $fonts=__DIR__.'/fonts/'.$fonts;

        //2.1生成图片资源
        $img=imagecreatetruecolor($width,$height);

        //2.2填充背景色
        $bg_color=imagecolorallocate($img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        imagefill($img,0,0,$bg_color);

        //3.增加干扰点
        for($i=0;$i<50;$i++){
            //随机颜色
            $dot_color=\imagecolorallocate($img,mt_rand(140,190),mt_rand(140,190),mt_rand(140,190));
            //使用*作为干扰点
            imagestring($img,mt_rand(1,5),mt_rand(0,$width),mt_rand(0,$height),'*',$dot_color);
        }

        //4.增加干扰线
        for($i = 0;$i < 10;$i++){
            //线段颜色
            $line_color = imagecolorallocate($img, mt_rand(80,130), mt_rand(80,130), mt_rand(80,130));
            //随机线段
            imageline($img, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), 
            $line_color);
        }
        
        //5.获取随机字符
        $captcha=self::getString($length);

        //6.保存到session
        @session_start();
        $_SESSION['captcha']=$captcha;

        //7.写入图片
        for($i = 0;$i < $length;$i++){
            //给每个字符分配不同颜色
            $c_color = imagecolorallocate($img, mt_rand(0,60), mt_rand(0,60), mt_rand(0,60));
            
            //增加字体空间、大小、角度显示
            imagettftext($img, mt_rand(15,25), mt_rand(-45,45), $width/($length+1)*($i+1), mt_rand(25,$height-25), $c_color,$fonts, $captcha[$i]);
        }

        //8.输出：错误调试时应该注释header
        header('Content-type:image/png');
        imagepng($img);

        //9.销毁资源
        imagedestroy($img);
        

    }

   //生成随机字符串：利用chr()将数字转换成ASCII字符
    public static function getString($length=4){
        //从ASCII码中获取
        $captcha = '';

        //随机取：大写、小写、数字
        for($i = 0;$i < $length; $i++){
            //随机确定是字母还是数字
            switch(mt_rand(1,3)){
                case 1:				//数字：49-57分别代表1-9
                    $captcha .= chr(mt_rand(49,57));	
                    break;
                case 2:				//小写字母
                    $captcha .= chr(mt_rand(65,90));
                    break;
                case 3:				//大写字母
                    $captcha .= chr(mt_rand(97,122));
                    break;
            }
	    }
		
        //返回
        return $captcha;
    }

    //校验验证码正确性
    public static function checkCaptcha($captcha){
        @session_start();
        //不区分大小写
        return (strtolower($captcha) === strtolower($_SESSION['captcha']));
    }



}


