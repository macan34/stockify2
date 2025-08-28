<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Setting; // Import Model Setting

class ApplySettings
{
    public function handle(Request $request, Closure $next)
    {
        // Gunakan Model Setting langsung instead of helper functions
        View::share('appSettings', [
            'name' => Setting::getValue('app_name', config('app.name')),
            'title' => Setting::getValue('app_title', config('app.name')),
            'logo' => $this->getLogoUrl(),
            'favicon' => $this->getFaviconUrl(),
            'theme' => Setting::getValue('theme', 'light')
        ]);

        return $next($request);
    }

    /**
     * Get logo URL
     */
    private function getLogoUrl()
    {
        $logo = Setting::getValue('logo');
        return $logo ? asset('storage/' . $logo) : asset('images/logo.png');
    }

    /**
     * Get favicon URL
     */
    private function getFaviconUrl()
    {
        $favicon = Setting::getValue('favicon');
        return $favicon ? asset('storage/' . $favicon) : asset('images/favicon.ico');
    }
}