<?php

namespace App\DesignPattern\Middleware;


use Closure;

interface Middleware
{
    public static function handle(Closure $next);
}
