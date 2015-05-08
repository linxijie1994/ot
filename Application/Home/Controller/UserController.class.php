<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use User\Api\UserApi;

/**
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class UserController extends HomeController {

	/* 用户中心首页 */
	public function index(){
		
	}

	/* 注册页面 */
	public function register($username = '', $password = '', $repassword = '',$email = '', $verify = ''){
        $info = array();
        if(!C('USER_ALLOW_REGISTER')){
            $this->error('注册已关闭');
        }
		if(IS_POST){ //注册用户
            //验证用名是否注册
            
            $where['name'] = $username;
            $r = M('user')->where($where)->count();
            if($r){
                $info['info'] = "用户名被注册";
                $info['status'] = false;
                $this->ajaxReturn($info);
            }
			
            if($password==''){
                 $info['info'] = "密码不能为空";
                $info['status'] = false;
                $this->ajaxReturn($info);
            }
			/* 检测密码 */
			if($password != $repassword){
				$info['info'] = "输入的两次密码不一样";
                $info['status'] = false;
                $this->ajaxReturn($info);
			 }
             if($email==''){
                $info['info'] = "请输入邮箱";
                $info['status'] = false;
                $this->ajaxReturn($info);
             }
             /* 检测验证码 */
            if(!check_verify($verify)){
                $info['info'] = "请输入正确的验证码";
                $info['status'] = false;
                $info['v_status'] = true;
                $this->ajaxReturn($info);
            }
             $data['name'] = $username;
             $data['password'] = $password;
             $data['sex'] = I('sex');
             $data['email'] = $email;
             $data['reg_time'] = time();
             $data['type'] = 0;
             $data['status'] = 0;
             $res = M('user')->add($data);
             if($res){
                session('uid',$res);//注册成功，登录
                $info = array('status'=>true,'url'=>U('Home/index'));
                $this->ajaxReturn($info);
             }
        } 
        else { //显示注册表单
			$this->display();
		}
	}

	/* 登录页面 */
	public function login($username = '', $password = '', $verify = ''){
		if(IS_POST){ //登录验证
            $info = array();
            /* 检测验证码 */
            if(!check_verify($verify)){
                $info['info'] = "输入的验证码有误!!!";
                $info['v_status'] = true;
                $info['status'] = false;
                $this->ajaxReturn($info);
            }
            if($username==''){
                $info['info'] = "请输入用户名!!!";
                $info['status'] = false;
                $this->ajaxReturn($info);
            }else{
                $map['name'] = $username;
                $re = M('user')->where($map)->count();
                if($re!=1){
                    $info['info'] = "用户名不存在!!!";
                    $info['status'] = false;
                    $this->ajaxReturn($info);
                }
            }
            if($password==''){
                $info['info'] = "请输入密码!!!";
                $info['status'] = false;
                $this->ajaxReturn($info);
            }else{
                $where['password'] = $password;
                $where['name'] = $username;
                $re = M('user')->where($where)->find();
                if($re == ''){
                    $info['info'] = "密码错误!!!";
                    $info['status'] = false;
                    $this->ajaxReturn($info);
                }else{
                    $_SESSION['zzc']['id'] = $re['id'];
                    $_SESSION['zzc']['time'] = time();
                    $_SESSION['zzc']['zzc'] = 1;
                    $info['info'] = "登录成功";
                    $info['status'] = true;
                    $info['url'] = U('Index/index');
                    $this->ajaxReturn($info);
                }
            }
	    }else{
         $this->display();
        }
    }
	/* 退出登录 */
	public function logout(){
		if(isLogin()){
            unset($_SESSION['zzc']['zzc']);
            unset($_SESSION['zzc']['id']);
            unset($_SESSION['zzc']['time']);
			$this->success('退出成功！', U('User/login'));
		} else {
			$this->redirect('User/login');
		}
	}

	/* 验证码，用于登录和注册 */
	public function verify(){
		$verify = new \Think\Verify();
		$verify->entry(1);
	}


}
