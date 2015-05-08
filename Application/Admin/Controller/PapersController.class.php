<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use User\Api\UserApi;

/**
 * 试卷管理控制器
 * @author zzc <fjszzzc@sina.com>
 */
class PapersController extends AdminController {
    public function index(){
        $this->display();
    }
    public function add(){
        if(IS_AJAX){
            $type = I('type');
            //添加题目 1-填空题 2-判断题 3-选择题 4-操作题
            switch ($type) {
                case '1':
                    $data['question'] = I('fi_question');
                    $data['answer'] = I('fi_answer');
                    $data['level'] = I('fi_level');
                    $data['remark'] = I('fi_remark');
                    $data['unit'] = I('fi_unit');
                    $data['tid'] = 1;
                    $data['time'] = time();
                    $res = M('fi_question')->add($data);
                    if($res){
                        $info['status'] = true;
                    }else{
                        $info['status'] = false;
                    }
                    break;
                case '2':
                    $data['question'] = I('rw_question');
                    $data['answer'] = I('rw_answer');
                    $data['level'] = I('rw_level');
                    $data['remark'] = I('rw_remark');
                    $data['unit'] = I('rw_unit');
                    $data['tid'] = 1;
                    $data['time'] = time();
                    $res = M('rw_question')->add($data);
                    if($res){
                        $info['status'] = true;
                    }else{
                        $info['status'] = false;
                    }
                    break;
                case '3':
                    $data['question'] = I('ch_question');
                    $data['answer'] = I('ch_answer');
                    $data['level'] = I('ch_level');
                    $data['remark'] = I('ch_remark');
                    $data['unit'] = I('ch_unit');
                    $data['ch1'] = I('ch1');
                    $data['ch2'] = I('ch2');
                    $data['ch3'] = I('ch3');
                    $data['ch4'] = I('ch4');
                    $data['tid'] = 1;
                    $data['time'] = time();
                    $res = M('choice_question')->add($data);
                    if($res){
                        $info['status'] = true;
                    }else{
                        $info['status'] = false;
                    }
                    break;
                default:
                   
                    break;
            }
            $this->ajaxReturn($info);
        }else{
            $this->display();
        }
    }
   
}