<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Helper function untuk mengakses nilai setting
     */
    function setting($key, $default = null)
    {
        try {
            return Setting::getValue($key, $default);
        } catch (\Exception $e) {
            return $default;
        }
    }
}

if (!function_exists('app_logo')) {
    /**
     * Helper function untuk mendapatkan URL logo
     */
    function app_logo()
    {
        try {
            $logo = setting('logo');
            return $logo ? asset('storage/' . $logo) : asset('images/logo.png');
        } catch (\Exception $e) {
            return asset('images/logo.png');
        }
    }
}

if (!function_exists('app_favicon')) {
    /**
     * Helper function untuk mendapatkan URL favicon
     */
    function app_favicon()
    {
        try {
            $favicon = setting('favicon');
            return $favicon ? asset('storage/' . $favicon) : asset('images/favicon.ico');
        } catch (\Exception $e) {
            return asset('images/favicon.ico');
        }
    }
}

if (!function_exists('app_name')) {
    /**
     * Helper function untuk mendapatkan nama aplikasi
     */
    function app_name()
    {
        try {
            return setting('app_name', config('app.name'));
        } catch (\Exception $e) {
            return config('app.name');
        }
    }
}

if (!function_exists('app_title')) {
    /**
     * Helper function untuk mendapatkan title aplikasi
     */
    function app_title()
    {
        try {
            return setting('app_title', config('app.name'));
        } catch (\Exception $e) {
            return config('app.name');
        }
    }
}