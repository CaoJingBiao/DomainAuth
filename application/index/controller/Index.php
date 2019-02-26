<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\DB;
use think\Exception;

class Index extends Base
{
    public function index(Request $request)
    {
    	if($request->isAjax()){
    		$domain = input('get.sv');
    		//查询域名是否授权
    		$sres = model('authorize')->getauthorize($domain);
    		if($sres!=null){
                $ysqmsg = "查询域名：".$domain."<br>授权状态：<font color='red'>已授权</font><br>到期时间：<font color='red'>".date('Y/m/d',$sres['time'])."</font>";
    			return $this->success($ysqmsg);
    		}else{
                $wsqmsg = "查询域名：".$domain."<br>授权状态：<font color='red'>未授权</font>";
    			return $this->error($wsqmsg);
    		}
    	}else{
	    	return view();
		}
    }

     public function selfhelp(Request $request)
    {
        if($request->isAjax()){
            $domain = input('post.domain');
            $ip = input('post.ip');
            $qq = input('post.qq');
            $km = input('post.km');
            $reg_ip = $request->ip();
            //确认输入的域名是否已经授权
            $authmsg = db('authorize')->where('domain',$domain)->find();
            if($authmsg!=null){
                 return $this->error('该域名已授权！');
            }
            //先查询卡密是否存在
            $camimsg = db('kami')->where('km',$km)->find();
            if($camimsg==null){
                return $this->error('该卡密无效，请确认是否输入错误！');
            }
            //授权有效期=卡密时长加上当前激活时间
            $sqtime = $camimsg['time']*31536000+time();
            //将授权信息写入授权表和卡密log，再删除卡密表中已经使用的卡密
            Db::startTrans();
            try{
                    Db::table('sq_authorize')->insert([
                        'username'=>$reg_ip,
                        'domain'=>$domain,
                        'ip'=>$ip,
                        'qq'=>$qq,
                        'time'=>$sqtime,
                        'ip_qh'=>1,
                        'yumi'=>0,
                        'p_id'=>1
                    ]);
                    Db::table('sq_kamilog')->insert([
                        'domain'=>$domain,
                        'km'=>$km,
                        'time'=>$camimsg['time'],
                        'usetime'=>time(),
                        ]);
                    Db::table('sq_kami')->where('km',$km)->delete();
                    Db::table('sq_daoban')->where('domain',$domain)->delete();
                    Db::commit();   
                } catch (\Exception $e) {
                    Db::rollback();
                    return $this->error('授权失败，请联系管理员！');
                }
                return $this->success('授权成功！',url('index/index/index')); 
        }else{
            return view();
        }
    }
}
