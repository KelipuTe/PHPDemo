<?php

require 'VerifyCsrfToekn.php';
require 'VerifyAuth.php';
require 'CookieHandler.php';

use App\DesignPattern\Middleware\VerifyCsrfToekn;
use App\DesignPattern\Middleware\VerifyAuth;
use App\DesignPattern\Middleware\CookieHandler;

$handle = function () {
    echo "要执行的程序。\n";
};

// 顺序调用的方式
function call_middleware($handle)
{
    VerifyCsrfToekn::handle(function () use ($handle) {
        VerifyAuth::handle(function () use ($handle) {
            CookieHandler::handle($handle);
        });
    });
}

call_middleware($handle);

echo "<br>\n";

// 管道调用的方式
$pipeArray = [
    'App\DesignPattern\Middleware\VerifyCsrfToekn',
    'App\DesignPattern\Middleware\VerifyAuth',
    'App\DesignPattern\Middleware\CookieHandler'
];

$callback = array_reduce(
    $pipeArray,
    function ($stack, $pipe) {
        return function () use ($stack, $pipe) {
            return $pipe::handle($stack);
        };
    },
    $handle
);

call_user_func($callback);
