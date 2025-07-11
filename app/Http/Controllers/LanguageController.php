<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Change the application locale
     */
    public function changeLocale(Request $request, $locale)
    {
        $availableLocales = config('app.available_locales', ['ja', 'vn']);
        
        if (array_key_exists($locale, $availableLocales)) {
            Session::put('locale', $locale);
        }
        
        return redirect()->back();
    }

    /**
     * Get available locales
     */
    public function getAvailableLocales()
    {
        return config('app.available_locales', ['ja' => '日本語', 'vn' => 'Tiếng Việt']);
    }
} 