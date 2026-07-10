<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class BrandingController extends Controller
{
    public function edit(): View
    {
        abort_if(auth()->user()->role !== 'admin', 403);
        return view('settings.branding');
    }

    public function update(Request $request): RedirectResponse
    {
        abort_if(auth()->user()->role !== 'admin', 403);
        $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
            'site_favicon' => ['nullable', 'file', 'mimes:ico,png,jpg,jpeg,svg', 'max:1024'],
        ]);

        Setting::setValue('site_name', $request->input('site_name'));

        // Handle custom logo upload
        if ($request->hasFile('site_logo')) {
            $logoFile = $request->file('site_logo');
            $logoFolder = public_path('uploads/branding');
            
            // Ensure folder exists
            if (!File::exists($logoFolder)) {
                File::makeDirectory($logoFolder, 0755, true);
            }

            // Delete old logo if exists
            $oldLogo = Setting::getValue('site_logo');
            if ($oldLogo && File::exists(public_path($oldLogo))) {
                File::delete(public_path($oldLogo));
            }

            // Save new logo
            $logoName = 'logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->move($logoFolder, $logoName);
            Setting::setValue('site_logo', 'uploads/branding/' . $logoName);
        }

        // Handle custom favicon upload
        if ($request->hasFile('site_favicon')) {
            $faviconFile = $request->file('site_favicon');
            $faviconFolder = public_path('uploads/branding');

            // Ensure folder exists
            if (!File::exists($faviconFolder)) {
                File::makeDirectory($faviconFolder, 0755, true);
            }

            // Delete old favicon if exists
            $oldFavicon = Setting::getValue('site_favicon');
            if ($oldFavicon && File::exists(public_path($oldFavicon))) {
                File::delete(public_path($oldFavicon));
            }

            // Save new favicon
            $faviconName = 'favicon_' . time() . '.' . $faviconFile->getClientOriginalExtension();
            $faviconFile->move($faviconFolder, $faviconName);
            Setting::setValue('site_favicon', 'uploads/branding/' . $faviconName);
        }

        return redirect()->route('settings.branding.edit')->with('success', 'Pengaturan branding web berhasil diperbarui! 🌷');
    }
}
