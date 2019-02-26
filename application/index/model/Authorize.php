<?php
  namespace app\index\model;
  use think\Model;

  class Authorize extends Model
  { 
  	 public function getauthorize($url){
  	 	$data = db('authorize')->where('domain',$url)->find();
  	 	return $data;
  	 }

  }