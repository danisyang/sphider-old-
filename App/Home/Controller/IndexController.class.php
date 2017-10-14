<?php
/**
 *
 * 版权所有：恰维网络<qwadmin.qiawei.com>
 * 作    者：寒川<hanchuan@qiawei.com>
 * 日    期：2016-01-21
 * 版    本：1.0.0
 * 功能说明：前台控制器演示。
 *
 **/
namespace Home\Controller;

use Vendor\Page;

class IndexController extends ComController
{
    public function index()
    {
        $this->display();
    }

    public function getData(){
      $order_id = I("oid");
      $name = I("name");
      $num = I("num");
      $payway = I("payway");
      $dealtime=I("dealtime");
      $link_href=I("link_href");
      $money_thing=I("money_thing");
      $source_id=I("source_id");
      $user_name = I("user_name");

      $dat["order_id"] = $order_id;
      $dat["name"] = $name;
      $dat["num"] = $num;
      $dat["payway"] = $payway;
      $dat["dealtime"]=$dealtime;
      $dat["link_href"]=$link_href;
      $dat["money_thing"]=$money_thing;
      $dat["source_id"]=$source_id;
      $dat["user_name"] = $user_name;
      $id = M("data")->add($dat);
      dump($id);die;
    }
    public function register(){
    //注册数据传输到数据库中去
        $infomation = M('User');
            if(!empty($_POST)){
            $arg = $_POST;
            dump($arg);
            $z = $infomation->add($arg);
            if($z){
                $this->redirect('Info/info');
            }else{
                echo "failure";
            }
        }
    }
    public function login(){

        $username = isset($_POST['name']) ? trim($_POST['name']) : '';
        //$password = isset($_POST['password']) ? password(trim($_POST['password'])) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        if ($username == '') {
            $this->error('用户名不能为空！', U("Index/index"));
        } elseif ($password == '') {
            $this->error('密码必须！', U("Index/index"));
        }

        $model = M("User");
        $condition['name']=$username;
        $condition['password']=$password;
        $ans = $model->field('id,name')->where($condition)->find();

        $verify = new \Think\Verify();


        if ($ans&&($verify->check($_POST['checkcode']))){
            echo 'login success!';
            session("mg_username",$ans['name']);
            session("mg_id",$ans['id']);
            $this->redirect('Info/info');
        } else if(!$verify->check($_POST['checkcode'])){
            echo '验证码错误';
            $this->error("验证码错误",'index.php/Home/Index');
        }
        else{
            echo 'login error';
            $this->error("登陆失败",U('Index/index'));
        }
        /*if ($user) {
            $salt = C("COOKIE_SALT");
            $ip = get_client_ip();

            $ua = $_SERVER['HTTP_USER_AGENT'];
            session_start();
            session('uid',$user['uid']);
            //加密cookie信息
            $auth = password($user['uid'].$user['user'].$ip.$ua.$salt);
            if ($remember) {
                cookie('auth', $auth, 3600 * 24 * 365);//记住我
            } else {
                cookie('auth', $auth);
            }
            addlog('登录成功。');
            $url = U('index/index');
            header("Location: $url");
            exit(0);
        } else {
            addlog('登录失败。', $username);
            $this->error('登录失败，请重试！', U("login/index"));
        }*/
    }
    public function verifyImg(){
        $config =	array(

            'fontSize'  =>  15,              // 验证码字体大小(px)
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'imageH'    =>  34,               // 验证码图片高度
            'imageW'    =>  200,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '',              // 验证码字体，不设置随机获取
            'bg'        =>  array(243, 251, 254),  // 背景颜色
        );
        $verify = new \Think\Verify($config);
        $verify ->entry();
        dump($verify);
    }


    public function logout(){
        session(null);//删除session信息
        $this->redirect("Index/index");//跳转到主页
    }
    public function registerpage(){
        $this->display();
    }
    public function doregisterpage(){
        dump($_POST);
        if($_POST){
            $this->redirect('Info/info');
        }
    }
}
 ?>
