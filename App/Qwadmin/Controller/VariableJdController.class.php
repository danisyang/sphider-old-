<?php
/**
 * Created by PhpStorm.
 * User: Dennis Yang
 * Date: 2017/9/28
 * Time: 11:08
 * 功能：jd数据展示控制器
 */
namespace Qwadmin\Controller;

class VariableJdController extends ComController
{

    public function index()
    {

        /*$vars = M('setting')->where('type=1')->select();
        $this->assign('vars', $vars);
        $this->display();*/
        $Data = M("data");
        $condition['source_id'] = '0';
        $count = $Data->where($condition)->count();
        $Page = new \Think\Page($count,20);
        $show = $Page->show();
        $vars = $Data->where($condition)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign("vars",$vars); //对模板进行赋值，Volist 展示数据
        $this->assign('page',$show);
        $this->display();
    }

    public function add()
    {

        $this->display('form');
    }

    public function edit($k = null)
    {

        $var = M('setting')->where("k='$k'")->find();
        if (!$var) {
            $this->error('参数错误！');
        }
        $this->assign('var', $var);
        $this->display('form');
    }

    public function del()
    {

        $k = I('get.k');
        if ($k <> '') {
            if (M('setting')->where("type=1 and k='{$k}'")->delete()) {
                addlog('删除自定义变量，ID：' . $k);
                $this->success('恭喜，删除成功！');
            } else {
                $this->error('参数错误！');
            }
        } else {
            $this->error('参数错误！');
        }
    }

    public function update()
    {

        $data['k'] = I('post.k');
        $varname = I('post.varname');
        if ($data['k'] == '') {
            $this->error('变量名不能为空。');
        }
        if (M('setting')->where("k='{$data['k']}'")->count() && $varname == '') {
            $this->error('变量名称已经存在。');
        }
        $data['v'] = I('post.v');
        $data['name'] = I('post.name');
        $data['type'] = 1;//自定义
        if ($varname == '') {
            M('setting')->data($data)->add();
            addlog('新增自定义变量：' . $data['k']);
        } else {
            M('setting')->data($data)->where("k='{$varname}'")->save();
            addlog('新增自定义变量：' . $data['k']);
        }

        $this->success('恭喜，操作成功！', U('index'));
    }
}