<?php

namespace App\DesignPattern\Middleware;


require_once 'Middleware.php';

use Closure;

class VerifyCsrfToekn implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "验证 CSRF Token。\n";

        $next();
    }
}
