<?php

namespace App\DesignPattern\Middleware;


require_once 'Middleware.php';

use Closure;

class VerifyAuth implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "验证是否登录。\n";

        $next();
    }
}