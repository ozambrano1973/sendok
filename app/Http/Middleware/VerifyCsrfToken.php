<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'foo/bar',
        'foo/*',
        'http://localhost/desarrollo/public/*',
        'http://http://sendok.cl/desarrollo/public/*',
        'sendok.cl/desarrollo/public/*',
        'www.sendok.cl/desarrollo/public/*'
    ];
}
