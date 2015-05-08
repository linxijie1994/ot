<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * 前台公共库文件
 * 主要定义前台公共函数库
 */

/**
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean     检测结果
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function check_verify($code, $id = 1){
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}

/**
 * 获取列表总行数
 * @param  string  $category 分类ID
 * @param  integer $status   数据状态
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_list_count($category, $status = 1){
    static $count;
    if(!isset($count[$category])){
        $count[$category] = D('Document')->listCount($category, $status);
    }
    return $count[$category];
}

/**
 * 获取段落总数
 * @param  string $id 文档ID
 * @return integer    段落总数
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_part_count($id){
    static $count;
    if(!isset($count[$id])){
        $count[$id] = D('Document')->partCount($id);
    }
    return $count[$id];
}

/**
 * 获取导航URL
 * @param  string $url 导航URL
 * @return string      解析或的url
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_nav_url($url){
    switch ($url) {
        case 'http://' === substr($url, 0, 7):
        case '#' === substr($url, 0, 1):
            break;        
        default:
            $url = U($url);
            break;
    }
    return $url;
}
function get_ch1($a1,$a2,$a3,$a4,$a5){
    $num = 4 ;
    $arr = array($a1);
    $tmp_arr = array($a2,$a3,$a4,$a5);
    for($i=0;$i<3;$i++){      
        $tmp = rand(1,10)%$num;
        array_push($arr,$tmp_arr[$tmp]);
        array_splice($tmp_arr,$tmp,1);
        $num--;
    }
    $tmp1 = rand(1,10)%4;
    if($tmp1 != 0){
        $t1 = $arr[0];
        $t2 = $arr[$tmp1];
        $arr[0] = $t2;
        $arr[$tmp1] =$t1;
    }
    return $arr;
}
function get_ch2($a1,$a2,$a3,$a4,$a5){
    $num = 4 ;
    $arr = array($a1);
    $tmp_arr = array($a2,$a3,$a4,$a5);
    for($i=0;$i<4;$i++){      
        $tmp = rand(1,10)%$num;
        array_push($arr,$tmp_arr[$tmp]);
        array_splice($tmp_arr,$tmp,1);
        $num--;
    }
    $tmp1 = rand(1,10)%4;
    if($tmp1 != 0){
        $t1 = $arr[0];
        $t2 = $arr[$tmp1];
        $arr[0] = $t2;
        $arr[$tmp1] =$t1;
    }
    return $arr;

}
