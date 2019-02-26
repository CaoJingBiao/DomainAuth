<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\DB;
use think\Exception;

class Api extends controller
{
	public function index(Request $request){
		if($request->isGet()){
			$data=[];
			$key = input('key');
			$domain = input('domain');
			$topdomain = input('topdomain');
			$ip = $request->ip();
			$msg = ['code'=>'404','msg'=>'参数错误'];
			$sqmsg = db('authorize')->where('domain',$domain)->find();
			$topdomainmsg = db('authorize')->where('domain',$topdomain)->find();
			$message = db('message')->find();
			if(empty($domain)||empty($topdomain)||($key!='client_check')){
				return json_encode($msg,JSON_UNESCAPED_UNICODE);
			}
			$ipreg = "/\b([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}\b/";
			if(!preg_match($ipreg,$topdomain)||!preg_match($ipreg,$domain)){
				$data['message']=$message['message_4'];
				return json_encode($data,JSON_UNESCAPED_UNICODE);
			}
			if(($topdomainmsg==null)||(($topdomainmsg!=null)&&($topdomainmsg['yumi']!='1'))){
				if($sqmsg==null){
					$daobanmsg = db('daoban')->where('domain',$domain)->find();
						if($daobanmsg!=null){
							db('daoban')->where('domain',$domain)->update([
								'time'=>time(),
								'ip'=>$ip
							]);
						}else{
							db('daoban')->insert([
								'domain'=>$domain,
								'time'=>time(),
								'ip'=>$ip
							]);
						}
						$data['message']=$message['message_1'];
						return json_encode($data,JSON_UNESCAPED_UNICODE);
					}elseif($sqmsg['time']<time()){
						$data['message']=$message['message_2'];
						return json_encode($data,JSON_UNESCAPED_UNICODE);
					}elseif(($sqmsg['ip_qh']=='1')&&($sqmsg['ip']!=$ip)){
						$data['message']=$message['message_3'];
						return json_encode($data,JSON_UNESCAPED_UNICODE);
					}
					$data['code']='0';
					$data['error']=$message['message_0'];
					return json_encode($data,JSON_UNESCAPED_UNICODE);
				}else{
					if($topdomainmsg['time']<=time()){
						$data['message']=$message['message_2'];
						return json_encode($data,JSON_UNESCAPED_UNICODE);
					}
					$data['code']='0';
					$data['error']=$message['message_0'];
					return json_encode($data,JSON_UNESCAPED_UNICODE);
				}
		}else{
			$msg = ['code'=>'404','msg'=>'参数错误'];
			echo json_encode($msg,JSON_UNESCAPED_UNICODE);
		}
	}
}