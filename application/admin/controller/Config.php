<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Config extends Base
{
    public function setup(Request $request)
    {
        if($request->isAjax()){
            $yxtime = strtotime(input('yxtime'));
            $updatemsg=db('site')->where('id',1)->update([
                'title'=>input('title'),
                'yxtime'=>$yxtime,
                'copyright'=>input('copyright'),
                'route'=>input('route')
            ]);
            if($updatemsg){
                    return $this->success('配置修改成功',url('admin/config/setup'));
              }else{
                    return $this->error('配置修改失败');
              }
        }else{
            //查询数据库设置信息
            $basemsg = db('site')->find();
            $this->assign('basemsg',$basemsg);
            return view();
        }
    }

    public function message(Request $request){
        if($request->isAjax()){
            $updatemsg=db('message')->where('id',1)->update([
                'message_0'=>input('message_0'),
                'message_1'=>input('message_1'),
                'message_2'=>input('message_2'),
                'message_3'=>input('message_3'),
                'message_4'=>input('message_4'),
            ]);
            if($updatemsg){
                    return $this->success('授权提示修改成功',url('admin/config/message'));
              }else{
                    return $this->error('授权提示修改失败');
              }
        }else{
            //查询数据库设置信息
            $messagemsg = db('message')->find();
            $this->assign('messagemsg',$messagemsg);
            return view();
        }
    }

    public function selfhelp(Request $request){
    	if($request->isAjax()){
            $updatemsg=db('selfhelp')->where('id',1)->update([
                'prompt'=>input('prompt'),
                'website'=>input('website'),
                'qq'=>input('qq'),
            ]);
            if($updatemsg){
                    return $this->success('自助提示修改成功',url('admin/config/selfhelp'));
              }else{
                    return $this->error('自助提示修改失败');
              }
        }else{
            //查询数据库设置信息
            $helpmsg = db('selfhelp')->find();
            $this->assign('selfhelp',$helpmsg);
            return view();
        }
    }

    public function profile(Request $request){
    	if($request->isAjax()){
            //先确认旧密码是否正确
            $opassword = md5(input('opassword'));
            $umsg = db('user')->where('username',input('username'))->find();
            if($umsg['password']==$opassword){
                $updatemsg = db('user')->where('username',input('username'))->update([
                    'password'=>md5(input('password'))
                ]);
                if($updatemsg){
                    session(null);
                    return $this->success('密码修改成功',url('admin/index/login'));
                }else{
                    return $this->error('密码修改失败');
                }
            }else{
                return $this->error('旧密码错误，修改失败！');
            }
        }else{
            return view();
        }
    }
}