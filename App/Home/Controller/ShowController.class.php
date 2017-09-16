<?php
//show 京东淘宝页面的控制器。
namespace Home\Controller;

use Vendor\Page;

class ShowController extends ComController
{
    public function show_taobao()
    {


        $this->display();
    }
    public function show_jing()
    {
        $past = M("data");
       // dump($past);
        $list = M("data")->select();
       // dump($list);
       // die();
        $this->assign("list",$list); //对模板进行赋值，Volist 展示数据
        $this->display();
    }
    public function listData(){


//        dump($list);die;

    }
}
?>
