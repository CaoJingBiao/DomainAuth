<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\DB;

class Authorize extends Base
{
    public function index(Request $request)
    {
    	$con = [];
    	$type = input('get.type');
    	$kw = input('get.kw');
    	if($kw!=''){
    		$con[$type]=['like','%'.$kw.'%'];
    	}
    	$auths = db('authorize')->where($con)->order('id desc')->paginate(10);
    	$products = db('products')->select();
	    $this->assign('products',$products);
    	$this->assign('auths',$auths);
        return view();
    }

    public function add(Request $request){
    	if($request->isAjax()){
    		Db::startTrans();
            try{
			 	 Db::table('sq_authorize')->insert([
				  	'username'=>input('post.username'),
				  	'domain'=>input('post.domain'),
				  	'ip'=>input('post.ip'),
				  	'qq'=>input('post.qq'),
				  	'tel'=>input('post.tel'),
				  	'time'=>strtotime(input('post.time')),
				  	'version'=>input('post.version'),
				  	'ip_qh'=>input('post.ip_qh'),
				  	'yumi'=>input('post.yumi'),
				  	'p_id'=>input('post.ycp')
				  ]);
                 if(input('post.yumi')=='1'){
                Db::table('sq_daoban')->where('domain','like','%.'.input('post.domain'))->delete();
                 }
			 	 Db::table('sq_daoban')->where('domain',input('post.domain'))->delete();
			 	 Db::commit(); 
			  }catch (\Exception $e) {
                    Db::rollback();
                    return $this->error('添加授权失败！');
                }
                return $this->success('授权添加成功！',url('admin/Authorize/index'));
    	}else{
	    	$products = db('products')->select();
	    	$this->assign('products',$products);
	    	return view();
    	}
    }

    public function edit(Request $request){
    	if($request->isAjax()){
			  $auth_id = input('post.auth_id');
			Db::startTrans();
            try{  
			  Db::table('sq_authorize')->where('id',$auth_id)->update([
			  	'username'=>input('post.username'),
			  	'domain'=>input('post.domain'),
			  	'ip'=>input('post.ip'),
			  	'qq'=>input('post.qq'),
			  	'tel'=>input('post.tel'),
			  	'time'=>strtotime(input('post.time')),
			  	'version'=>input('post.version'),
			  	'ip_qh'=>input('post.ip_qh'),
			  	'yumi'=>input('post.yumi'),
			  	'p_id'=>input('post.ycp')
			  ]);
             if(input('post.yumi')=='1'){
                Db::table('sq_daoban')->where('domain','like','%.'.input('post.domain'))->delete();
                 }
			  Db::table('sq_daoban')->where('domain',input('post.domain'))->delete();
			  Db::commit(); 
			  }catch (\Exception $e) {
                    Db::rollback();
                    return $this->error('修改授权信息失败！');
              }
              return $this->success('修改授权信息成功！',url('admin/Authorize/index'));
    	}else{
	    	$auth_id = input('auth_id');
	    	$authmsg= db('authorize')->where('id',$auth_id)->find();
	    	$products = db('products')->select();
	    	$this->assign('products',$products);
	    	$this->assign('authmsg',$authmsg);
	    	return view();
    	}
    }

    public function del(Request $request){
    	if($request->isAjax()){
    		$auth_id = input('post.auth_id');
    		$delmsg = db('authorize')->delete($auth_id);
    		if($delmsg){
    			return $this->success('授权删除成功！');
    		}else{
    			return $this->error('授权删除失败！');
    		}
    	}
    }

}