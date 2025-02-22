<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class GeneratePrivateId
{
    public function handle(Request $request, Closure $next)
    {

    }
}
