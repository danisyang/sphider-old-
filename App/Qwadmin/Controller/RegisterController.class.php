<?php
/**
 * Created by PhpStorm.
 * User: Dennis Yang
 * Date: 2017/10/11
 * Time: 10:45
 * 功能说明：用户注册功能（如果手机号和用户名已经被注册，则返回注册失败，提示并重新注册）
 */

namespace Qwadmin\Controller;

//use Qwadmin\Controller\ComController;
use Common\Controller\BaseController;
use Think\Auth;

class RegisterController extends BaseController
{
    public function register(){//接收注册表单数据后，处理注册数据。
        //格式： ["user"]
        //      ["password"]
        //      ["phone"]
        $user = D("Member");
        if(!empty($_POST)){
            $data["user"] = $_POST["user"];
            $data["password"] = password($_POST["password"]);
            $data["phone"] = $_POST["phone"];
            //要先判断用户名、手机号是否已经被注册过了。如果注册过了，提示重新注册。
            $namecondition["user"] = $_POST["user"];
            $ansname = $user->where($namecondition)->find();//返回的结果是数组形式
            dump($ansname);
            $phonecondition["phone"] = $_POST["phone"];
            $ansphone = $user->where($phonecondition)->find();
            dump($ansphone);
            //判断一下用户名和手机号是否重复，如果重复弹出错误并再次转到注册页面。
            if(empty($ansname)&&empty($ansphone)){
                //能运行到这里说明注册的用户名和手机没有重复，可以添加数据了。
                $rst = $user->add($data);
                if($rst){
                    //下一步要做的是写入权限。3是默认的普通用户权限。
                    $auth_group_access = D("auth_group_access");
                    $condition['uid'] = $rst;
                    $condition['group_id'] = 3;
                    $ans = $auth_group_access->add($condition);
                    if($ans){
                        $this->success("注册成功",U("Index/index"));
                    }else{
                        $this->error("注册失败",U("Index/index"));
                    }
                }else{
                    $this->error("注册失败",U("Index/index"));
                }

            }else if (!empty($ansname)){
                //说明用户名值重复了，需要提示并转到注册页
                $this->error("用户名已被注册",U("Register/registerpage"));
            }else{
                //最后的情况说明是手机号被注册了，需要提示并转到页面
                $this->error("手机号已被注册",U("Register/registerpage"));
            }

        }

    }
    public function registerpage(){
        $this->display();
    }
}