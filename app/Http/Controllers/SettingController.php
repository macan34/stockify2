<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan
     */
    public function index()
    {
        // Ambil semua setting yang dikelompokkan
        $settings = Setting::getAllGrouped();
        
        return view('settings.index', compact('settings'));
    }

    /**
     * Memperbarui pengaturan
     */
    public function update(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'app_name' => 'required|string|max:255',
            'app_title' => 'required|string|max:255',
            'theme' => 'required|in:light,dark,blue,green',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update general settings
            Setting::setValue('app_name', $request->app_name);
            Setting::setValue('app_title', $request->app_title);
            Setting::setValue('theme', $request->theme);

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $this->handleLogoUpload($request->file('logo'));
            }

            // Handle favicon upload
            if ($request->hasFile('favicon')) {
                $this->handleFaviconUpload($request->file('favicon'));
            }

            return redirect()->route('settings.index')
                ->with('success', 'Pengaturan berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menangani upload logo
     */
    private function handleLogoUpload($file)
    {
        // Hapus logo lama jika ada
        $oldLogo = Setting::getValue('logo');
        if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
            Storage::disk('public')->delete($oldLogo);
        }

        // Simpan logo baru
        $logoPath = $file->store('settings', 'public');
        Setting::setValue('logo', $logoPath);
    }

    /**
     * Menangani upload favicon
     */
    private function handleFaviconUpload($file)
    {
        // Hapus favicon lama jika ada
        $oldFavicon = Setting::getValue('favicon');
        if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
            Storage::disk('public')->delete($oldFavicon);
        }

        // Simpan favicon baru
        $faviconPath = $file->store('settings', 'public');
        Setting::setValue('favicon', $faviconPath);
    }

    /**
     * Reset pengaturan ke default
     */
    public function reset()
    {
        try {
            // Reset ke nilai default
            Setting::setValue('app_name', 'Laravel Inventory');
            Setting::setValue('app_title', 'Sistem Manajemen Inventory');
            Setting::setValue('theme', 'light');

            // Hapus file logo dan favicon
            $logo = Setting::getValue('logo');
            $favicon = Setting::getValue('favicon');
            
            if ($logo && Storage::disk('public')->exists($logo)) {
                Storage::disk('public')->delete($logo);
            }
            if ($favicon && Storage::disk('public')->exists($favicon)) {
                Storage::disk('public')->delete($favicon);
            }

            Setting::setValue('logo', null);
            Setting::setValue('favicon', null);

            return redirect()->route('settings.index')
                ->with('success', 'Pengaturan berhasil direset ke default!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}