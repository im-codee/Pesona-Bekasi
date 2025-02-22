<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class GeneratePublicId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('get') && !$request->has('public_id')) {
            $publicId = Str::random(128);

            return redirect()->to($request->fullUrlWithQuery(['public_id' => $publicId]))
                            ->with('success', session('success'));
        }

        return $next($request);
    }

}
