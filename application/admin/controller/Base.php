<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Base extends Controller
{

  public function _initialize()
  {
    //获取正版数量
    $zbcounts = db('authorize')->count();
    $this->assign('zbcounts',$zbcounts);
    //查询盗版数量
    $dbcounts = db('daoban')->count();
    $this->assign('dbcounts',$dbcounts);
    //获取site数据信息
    $site = db('site')->where('id',1)->find();
    $this->assign('site',$site);
    //运行天数
    $yxts = round((time()-$site['yxtime'])/86400);
    $this->assign('yxts',$yxts);
    $ctl = request()->controller();
    $act = request()->action();
    $path = $ctl.$act;
    if($path == 'Indexlogin'){
          if(session('?username')){
            $this->success('您已经登录，跳转后台首页', url('admin/index/index'));
          }
    }else{
      if (!session('?username')){
        $this->error('请您先登录！', url('admin/index/login'));
      }
    }
  }
}
