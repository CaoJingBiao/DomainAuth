<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Daoban extends Base
{
    public function index()
    {
    	$daoban = db('daoban')->order('id desc')->paginate(10);
    	$this->assign('daoban',$daoban);
        return view();
    }

    public function daobandel(Request $request){
    	if($request->isAjax()){
    		$daoban_id = input('post.daoban_id');
    		$delmsg = db('daoban')->delete($daoban_id);
    		if($delmsg){
    			return $this->success('站点删除成功！');
    		}else{
    			return $this->error('站点删除失败！');
    		}
    	}
    }

}