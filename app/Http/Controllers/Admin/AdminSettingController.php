<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $this->ensureDefaultSettings();
        $settings = SiteSetting::orderBy('group')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = SiteSetting::pluck('key')->toArray();

        foreach ($keys as $key) {
            if ($request->has($key)) {
                $value = $request->input($key);
                if (is_array($value)) {
                    $value = json_encode($value);
                }
                SiteSetting::where('key', $key)->update(['value' => $value]);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }

    private function ensureDefaultSettings()
    {
        $defaults = [
            // Contact Info
            ['key' => 'contact_address', 'value' => '', 'group' => 'Kontak'],
            ['key' => 'contact_phone', 'value' => '', 'group' => 'Kontak'],
            ['key' => 'contact_email', 'value' => '', 'group' => 'Kontak'],
            ['key' => 'contact_map_link', 'value' => '', 'group' => 'Kontak'],
            // Hero Section
            ['key' => 'hero_title', 'value' => 'Rumah Harapan', 'group' => 'Hero'],
            ['key' => 'hero_subtitle', 'value' => 'Bersama Membangun Masa Depan', 'group' => 'Hero'],
            ['key' => 'hero_description', 'value' => '', 'group' => 'Hero'],
            ['key' => 'hero_image', 'value' => '', 'group' => 'Hero'],
            // Social Media
            ['key' => 'social_facebook', 'value' => '', 'group' => 'Sosial Media'],
            ['key' => 'social_instagram', 'value' => '', 'group' => 'Sosial Media'],
            ['key' => 'social_youtube', 'value' => '', 'group' => 'Sosial Media'],
            ['key' => 'social_twitter', 'value' => '', 'group' => 'Sosial Media'],
            // About
            ['key' => 'about_title', 'value' => 'Tentang Kami', 'group' => 'Tentang'],
            ['key' => 'about_content', 'value' => '', 'group' => 'Tentang'],
            ['key' => 'about_vision', 'value' => '', 'group' => 'Tentang'],
            ['key' => 'about_mission', 'value' => '', 'group' => 'Tentang'],
            // Site Info
            ['key' => 'site_name', 'value' => 'Rumah Harapan', 'group' => 'Umum'],
            ['key' => 'site_description', 'value' => '', 'group' => 'Umum'],
            ['key' => 'footer_text', 'value' => '© ' . date('Y') . ' Rumah Harapan. All rights reserved.', 'group' => 'Umum'],
        ];

        foreach ($defaults as $setting) {
            SiteSetting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }
    }
}
