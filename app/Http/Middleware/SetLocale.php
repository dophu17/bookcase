<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get available locales from config
        $availableLocales = config('app.available_locales', ['ja', 'vn']);
        
        // Check if locale is set in session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } 
        // Check if locale is in URL parameter
        elseif ($request->has('lang') && in_array($request->get('lang'), array_keys($availableLocales))) {
            $locale = $request->get('lang');
            Session::put('locale', $locale);
        }
        // Use default locale from config
        else {
            $locale = config('app.locale', 'ja');
        }

        // Set the application locale
        App::setLocale($locale);

        return $next($request);
    }
} 