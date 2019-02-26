<?php
namespace app\admin\model;
use think\Model;

class User extends Model
  {
  	 public function doLogin(){
    	 	$data=$this->where("username",input('post.username'))->find();
    	 	if($data==null){
    	 		return '用户名或密码错误!';
    	 	}
    	 	$password=md5(input('post.password'));
    	 	if($password!=$data->password){
    	 		return '用户名或密码错误!';
    	 	} 
        if(input('safepwd')!='2018'){
          return '安全码错误!';
        }				
    	 		session('username',$data->username);
          return true;
  	 	}
  }