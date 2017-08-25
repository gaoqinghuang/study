<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    'hello/[:name]$' => 'index/index/hello',
    'blog/:year/:month'=>['blog/archive',['method'=>'get'],['year'=>'\d{4}','month'=>'\d{2}']],
    'blog/:id'          => ['blog/get', ['method' => 'get'], ['id' => '\d+']],
    'blog/:name'        => ['blog/read', ['method' => 'get'], ['name' => '\w+']],
];
// 添加hello路由标识
Route::rule(['hello','hello/:name'], function($name){
    return 'Hello,'.$name;
});
// 根据路由标识快速生成URL
Url::build('hello', 'name=thinkphp');
// 或者使用
Url::build('hello', ['name' => 'thinkphp']);
