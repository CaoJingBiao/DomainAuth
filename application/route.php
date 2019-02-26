<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::rule([
    '/'=>'index/index/index',
    'self_help' => 'index/index/selfhelp',
    'api' => ['index/api/index',['method'=>'get']],
    'admin'=> 'admin/index/login',
    'admin/loginout'=> 'admin/index/loginout',
    'admin/index'=> 'admin/index/index',
    'admin/authorize'=> 'admin/authorize/index',
    'admin/authorize_add'=> 'admin/authorize/add',
    'admin/authorize_edit/:auth_id'=> ['admin/authorize/edit',['method'=>'get'],['auth_id'=>'\d+']],
    'admin/authorize_edito' => ['admin/authorize/edit',['method'=>'post']],
    'admin/authorize_del'=> 'admin/authorize/del',
    'admin/kami'=> 'admin/kami/index',
    'admin/kami_del'=> 'admin/kami/delkami',
    'admin/kami_creatkami'=> 'admin/kami/creatkami',
    'admin/kami_out/:execl'=> ['admin/kami/kamiout',['method'=>'get'],['execl'=>'\w{3}']],
    'admin/kami_log'=> 'admin/kami/log',
    'admin/generate'=> 'admin/generate/index',
    'admin/generate_jiami'=> 'admin/generate/jiami',
    'admin/products'=> 'admin/products/index',
    'admin/products_add'=> 'admin/products/add',
    'admin/products_edit/:p_id'=> ['admin/products/edit',['method'=>'get'],['p_id'=>'\d+']],
    'admin/products_edito'=> ['admin/products/edit',['method'=>'post']],
    'admin/products_del'=> 'admin/products/del',
    'admin/daoban'=> 'admin/daoban/index',
    'admin/daoban_del'=> 'admin/daoban/daobandel',
    'admin/setup'=> 'admin/config/setup',
    'admin/profile'=> 'admin/config/profile',
    'admin/message'=> 'admin/config/message',
    'admin/selfhelp'=> 'admin/config/selfhelp',
    'admin/verinfo'=> 'admin/verinfo/index',
]);