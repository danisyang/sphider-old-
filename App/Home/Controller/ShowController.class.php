<?php
//show 京东淘宝页面的控制器。
namespace Home\Controller;

use Vendor\Page;

class ShowController extends ComController
{
    public function show_taobao()
    {
        $Data = M("data");
        $condition['source_id'] = '1';
        $condition['user_id'] = $_SESSION['mg_id'];
        $count = $Data->where($condition)->count();
        $Page = new \Think\Page($count,10);
        $show = $Page ->show();
        $list_t = $Data->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign("list_t",$list_t); //对模板进行赋值，Volist 展示数据
        $this->assign('page',$show);
        $this->display();
    }
    public function show_jing()
    {
        //19~19 主要完成了数据的分页显示
        $Data = M("data");
        $condition['user_id'] = $_SESSION['mg_id'];//按照session的用户名
        $condition['source_id'] = '0';
        $count = $Data->where($condition)->count();
        $Page = new \Think\Page($count,10);
        $show = $Page->show();
        $list = $Data->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign("list",$list); //对模板进行赋值，Volist 展示数据
        $this->assign('page',$show);
        $this->display();
    }
    public function listData(){


//        dump($list);die;

    }
}
?>
