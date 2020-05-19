<?php

namespace App\DesignPattern\Middleware;


require_once 'Middleware.php';

use Closure;

class CookieHandler implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "获取 Cookie 信息。<br>\n";

        $next();

        echo "设置 Cookie 信息。<br>\n";
    }
}