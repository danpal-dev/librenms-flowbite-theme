<?php

/*
 * FlowbiteTheme — Settings Hook
 *
 * Global admin settings: accent colour, sidebar width and topbar height.
 * Stored as JSON in the Plugin.settings column. Applied as CSS custom
 * properties injected in <head> on every Flowbite layout page.
 */

namespace App\Plugins\FlowbiteTheme;

use App\Models\Plugin;
use App\Plugins\Hooks\SettingsHook;

class Settings extends SettingsHook
{
    /** Default values used when no settings have been saved yet. */
    public static array $defaults = [
        'accent_color'  => 'blue',
        'sidebar_width' => 'normal',
        'topbar_height' => 'normal',
        'font_size'     => 'normal',
        'spacing'       => 'normal',
        'font_family'   => 'inter',
    ];

    public function data(array $settings = []): array
    {
        // SettingsHook::handle() calls data() twice via $app->call().
        // The outer call receives the return value of the inner call
        // (['settings' => merged]), so we must unwrap to avoid nesting
        // the real values under a 'settings.settings' key.
        $real = isset($settings['settings']) && is_array($settings['settings'])
            ? $settings['settings']
            : $settings;

        return [
            'settings' => array_merge(static::$defaults, $real),
        ];
    }

    /**
     * Helper used by the Blade layout to read current settings without
     * going through the full hook/manager pipeline.
     */
    public static function getSettings(): array
    {
        $plugin = Plugin::where('plugin_name', 'FlowbiteTheme')->first();

        return array_merge(static::$defaults, $plugin?->settings ?? []);
    }
}
