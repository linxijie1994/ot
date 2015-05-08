<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: zzc <fjszzzc@sina.com> 
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台试题显示
 * 
 */
class PapersController extends HomeController {
    public function index(){
        $this->display();
    }
    public function showpapers(){
        $fi_list = $this->lists('fi_question');
        $rw_list = $this->lists('rw_question');
        $c1_list = $this->lists('choice_question','type=1');
        $c2_list = $this->lists('choice_question','type=2');
        $this->assign('c1_q',$c1_list);
        $this->assign('c2_q',$c2_list);
        $this->assign('fi_q',$fi_list);
        $this->assign('rw_q',$rw_list);
        $this->display('papaers');
    }
}