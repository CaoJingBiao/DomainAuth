<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use PHPExcel_IOFactory;
use PHPExcel;

class Kami extends Base
{
    public function index()
    {
    	$data = db('kami')->order('id desc')->paginate(10);
    	$this->assign('kami',$data);
        return view();
    }

    public function log(){
    	$data = db('kamilog')->order('id desc')->paginate(10);
    	$this->assign('log',$data);
    	return view();
    }

    public function creatkami(Request $request){
        if($request->isAjax()){
            $kmsl = input('kmsl');
            $ytime = input('ytime');
            for($i=1;$i<=$kmsl;$i++){
               $km =  creatkami();
               $insertmsg = db('kami')->insert([
                    'km'=>$km,
                    'time'=>$ytime,
                    'ctime'=>time()
               ]);
            }
            return $this->success('成功生成'.$kmsl.'张卡密',url('admin/kami/index'));           
        }
    }

    public function delkami(Request $request){
        if($request->isAjax()){
            $km_id = input('post.km_id');       
                $delmsg = db('kami')->delete($km_id);
                if($delmsg){
                     return $this->success('卡密删除成功！');
                }else{
                     return $this->error('卡密删除失败！');
                }
        }
    }

    public function kamiout(Request $request)
    {
        if($request->isGet()){
            if(input('execl')=='yes'){
                execlkami();
            }else{
                 return $this->error('别来捣蛋！');
            }
        }else{
            return $this->error('别来捣蛋！');
        }
    }

}