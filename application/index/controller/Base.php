<?php
namespace app\index\controller;
use think\Controller;
use think\Request;

class Base extends Controller
{

  public function _initialize()
  {
    //获取site数据信息
    $site = db('site')->where('id',1)->find();
    $this->assign('site',$site);
    //获取selfhelp数据
    $selfhelp = db('selfhelp')->where('id',1)->find();
    $this->assign('selfhelp',$selfhelp);
   }
    
}
