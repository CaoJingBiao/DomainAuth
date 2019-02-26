<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Generate extends Base
{
    public function index()
    {
        //获取本站域名
        $domain = $_SERVER['SERVER_NAME'];
        $this->assign('domain',$domain);
        return view();
    }

    public function jiami(){
    	return view();
    }

}