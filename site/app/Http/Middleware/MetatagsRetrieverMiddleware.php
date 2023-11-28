<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\MetatagsModel;

class MetatagsRetrieverMiddleware
{
    public function handle($request, Closure $next)
    {
        $rotaatual = \Route::currentRouteName();
        $rotaatual = $rotaatual == "home" ? "/" : $rotaatual;

        $metatags = MetatagsModel::where('pagina', $rotaatual)->first();
        
        // Compartilha $metatags com todas as views
        view()->share('metatag', $metatags);

        return $next($request);
    }
}
