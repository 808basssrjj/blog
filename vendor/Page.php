<?php

//文件上传类
namespace vendor;

class Page{


    /*
    * 分页功能：百度分页
    * @param1 string $url，基本链接（http://www.blog.com/index.php)
    * @param2 int $counts，记录数量
    * @param3 int $pagecount = 10，每页记录数，默认每页10条
    * @param4 int $page = 1，当前页码，默认第1页
    * @param5 array $cond = array()，连接资源：a条件，c条件，p条件，其他查询条件
        array('a' => 'index','c' => 'article', 'p' => 'admin')
    */
    public static function clickPage($url, $counts, $pagecount = 5, $page = 1, $cond = array()){
        //计算页码
        $pages = ceil($counts / $pagecount);
        $prev= $page>1 ? $page-1 : 1;
        $next = $page <$pages ? $page +1 :$pagess;

        //组织路径条件
        $pathinfo='';
        foreach($cond as $k => $v){
            $pathinfo.= $k .'=' .$v .'&';
        }

        //组织分页li标签
        //1.最左侧的上一页功能
        $click = "<li><a href='{$url}?{$pathinfo}page={$prev}'>上一页</a></li>";

        //2.中间的数字页码点击功能
       //页码点击判定
		if($pages <= 7){
			//有多少页点多少页
			for($i = 1;$i <= $pages;$i++){
				$click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
			}
        }else{
                //2.2页码总数超过7页，说明会存在...：根据当前页码来设定
                // 用户点击页码在5以内：显示前7页，后面增加...
                if($page<=5){
                    //2.2.1 组织前7页
                    for($i=1;$i<=7;$i++){
                        $click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
                    }
                    //追加...
                    $click .= "<li><a href='#'>...</a></li>";
                }else{
                    //2.2.2 选的页码大于5，显示前两页，后跟...
                    $click .= "<li><a href='{$url}?{$pathinfo}page=1'>1</a></li>";
                    $click .= "<li><a href='{$url}?{$pathinfo}page=2'>2</a></li>";
                    $click .= "<li><a href='#'>...</a></li>";

                     //要判定当前选择的页码是否是最后几页：最后是否增加...
                    if($pages - $page <= 3){
                        //2.2.2.1 当前页码已经选的是最后3页，显示后面5页即可
                        for($i = $pages - 4;$i <= $pages; $i++){
                            $click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
                        }
                    }else{
                        //2.2.2.2 当前页码选的为中间段：显示当前页码前后各两页，并且最后增加...
                        for($i = $page - 2;$i <= $page + 2;$i++){
                        $click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>"; 
                        }
                        //增加尾部...
                        $click .= "<li><a href='#'>...</a></li>";
                    }
                }
        }

        //3.补充下一页
        $click .= "<li><a href='{$url}?{$pathinfo}page={$next}'>下一页</a></li>";

        //返回得到的分页链接
        return $click;
    }
}