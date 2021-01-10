<?php

namespace Responsive\Http\Middleware;

use Closure;
use App;
use Config;
use Session;


class CharsetMiddleware
{
  public function handle($request, Closure $next)
    {
        $response = $next($request);
        $contentType = $response->headers->get('Content-Type');
        if (!empty($contentType)) {
            $response->header('Content-Type', str_replace('UTF-8', 'iso-8859-1', $contentType));
        }
        return $response;
    }
	
	
}