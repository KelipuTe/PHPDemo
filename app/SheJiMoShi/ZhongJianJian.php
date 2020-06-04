<?php

/* 中间件（Middleware） */

// 想象成一个类似洋葱的结构，一层一层进门，再一层一层出来
// 值得注意的是，进入时的第一个门，在出来的时候，是最后一个

interface Middleware
{
    public static function handle(Closure $next);
}

class VerifyCsrfToekn implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "验证 CSRF Token。" . PHP_EOL;
        $next();
    }
}

class VerifyAuth implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "验证是否登录。" . PHP_EOL;
        $next();
    }
}

class CookieHandler implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "获取 Cookie 信息。" . PHP_EOL;
        $next();
        echo "设置 Cookie 信息。" . PHP_EOL;
    }
}

$handle = function () {
    echo "要执行的程序。" . PHP_EOL;
};

/* 顺序调用的方式 */

function call_middleware($handle)
{
    VerifyCsrfToekn::handle(function () use ($handle) {
        VerifyAuth::handle(function () use ($handle) {
            CookieHandler::handle($handle);
        });
    });
}

/* 管道调用的方式 */

// 管道这里在前面的数组元素处理后会在内层
$pipeArray = [
    'CookieHandler',
    'VerifyAuth',
    'VerifyCsrfToekn',
];
// array_reduce(数组，函数，初始值)
// array_reduce() 的作用是使用函数依次处理数组中的值
$callback = array_reduce(
    $pipeArray,
    function ($stack, $pipe) {
        return function () use ($stack, $pipe) {
            return $pipe::handle($stack);
        };
    },
    $handle
);

/* 测试代码 */

echo "顺序调用的方式。" . PHP_EOL;
call_middleware($handle);
echo "管道调用的方式。" . PHP_EOL;
call_user_func($callback);