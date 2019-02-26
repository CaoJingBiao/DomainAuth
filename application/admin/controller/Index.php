<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Index extends Base
{
    public function login(Request $request)
    {
    	if($request->isPost()){
    		$res=model('User')->dologin(); 
        	if($res!==true){
          		return $this->error($res);
         	}else{
              return $this->success('登录成功',url('admin/index/index'));
          	}
    	}else{
        	return view();
    	}
    }

    public function loginout()
    {
        session(null);    
        $this->success('退出成功！', url('admin/index/login'));
    }

    public function index(){
    	//查询最近授权的5条记录
        $auth = db('authorize')->limit(5)->order('id desc')->select();
        $this->assign('authmsg',$auth);
        //查询最近5条盗版记录
        $daoban = db('daoban')->limit(5)->order('id desc')->select();
        $this->assign('daobanmsg',$daoban);
        $products = db('products')->select();
        $this->assign('products',$products);
    	return view();
    }

}