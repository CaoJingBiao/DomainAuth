<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Products extends Base
{
    public function index()
    {
    	$products = db('products')->order('id desc')->paginate(10);;
        $this->assign('products',$products);
        return view();
    }

    public function add(Request $request){
        if($request->isAjax()){
            $insertmsg = db('products')->insert([
                'cp'=>input('cp'),
                'ms'=>input('ms'),
                'time'=>time()
            ]);
            if($insertmsg){
                     return $this->success('产品添加成功！',url('admin/products/index'));
                }else{
                     return $this->error('产品添加失败！');
                }
        }else{
    	   return view();
        }
    }

    public function edit(Request $request){
        if($request->isAjax()){
            $updatemsg = db('products')->where('id',input('p_id'))->update([
                'cp'=>input('cp'),
                'ms'=>input('ms'),
                'time'=>time()
            ]);
            if($updatemsg){
                     return $this->success('分类信息修改成功！',url('admin/products/index'));
                }else{
                     return $this->error('分类信息修改失败！');
                }
        }else{
            $p_id = input('p_id');
            $productmsg = db('products')->where('id',$p_id)->find();
            $this->assign('pmsg',$productmsg);
            return view();
        }
    }

    public function del(Request $request){
        if($request->isAjax()){
            $product_id = input('post.product_id');
            //查询产品下是否有授权
            $authmsg = db('authorize')->where('p_id',$product_id)->find();
            if($authmsg==null){
                $delmsg = db('products')->delete($product_id);
                if($delmsg){
                     return $this->success('产品删除成功！');
                }else{
                     return $this->error('产品删除失败！');
                }
            }else{
                return $this->error('产品下有授权网站,无法删除！');
            }
        }
    }

}