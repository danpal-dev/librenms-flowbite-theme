@php
/*
 * CSS vars + font: injected on EVERY page (Bootstrap overlay + Flowbite sidebar).
 * Placed here because menu.blade.php runs via the Plugin menu hook on all pages,
 * including core pages that use layouts.librenmsv1 (not the Flowbite layout).
 */
$fbCfg = \App\Plugins\FlowbiteTheme\Settings::getSettings();

$fbPalettes = [
    'blue'    => ['500' => '#3b82f6', '600' => '#2563eb', '700' => '#1d4ed8'],
    'indigo'  => ['500' => '#6366f1', '600' => '#4f46e5', '700' => '#4338ca'],
    'violet'  => ['500' => '#8b5cf6', '600' => '#7c3aed', '700' => '#6d28d9'],
    'emerald' => ['500' => '#10b981', '600' => '#059669', '700' => '#047857'],
    'teal'    => ['500' => '#14b8a6', '600' => '#0d9488', '700' => '#0f766e'],
    'cyan'    => ['500' => '#06b6d4', '600' => '#0891b2', '700' => '#0e7490'],
    'rose'    => ['500' => '#f43f5e', '600' => '#e11d48', '700' => '#be123c'],
    'amber'   => ['500' => '#f59e0b', '600' => '#d97706', '700' => '#b45309'],
];
$fbAcc = $fbPalettes[$fbCfg['accent_color']] ?? $fbPalettes['blue'];

$fbFontUrls = [
    'inter'     => 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
    'geist'     => 'https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap',
    'roboto'    => 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap',
    'dm_sans'   => 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap',
    'jetbrains' => 'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&display=swap',
];
$fbFontStacks = [
    'inter'     => "'Inter', ui-sans-serif, system-ui, sans-serif",
    'geist'     => "'Geist', ui-sans-serif, system-ui, sans-serif",
    'roboto'    => "'Roboto', ui-sans-serif, system-ui, sans-serif",
    'dm_sans'   => "'DM Sans', ui-sans-serif, system-ui, sans-serif",
    'jetbrains' => "'JetBrains Mono', ui-monospace, 'Cascadia Code', monospace",
];
$fbFontKey  = $fbCfg['font_family'] ?? 'inter';
$fbFontUrl  = $fbFontUrls[$fbFontKey]  ?? $fbFontUrls['inter'];
$fbStack    = $fbFontStacks[$fbFontKey] ?? $fbFontStacks['inter'];

$fbFontSize = match($fbCfg['font_size'] ?? 'normal') {
    'small'  => '12px',
    'large'  => '14px',
    default  => '13px',
};
$fbSidebarWidth = ($fbCfg['sidebar_width'] ?? 'normal') === 'compact' ? '180px' : '220px';
$fbTopbarHeight = ($fbCfg['topbar_height'] ?? 'normal') === 'compact' ? '40px'  : '48px';
$fbSpacingNav   = match($fbCfg['spacing'] ?? 'normal') {
    'compact'     => '0.15rem', 'comfortable' => '0.5rem', default => '0.3rem',
};
$fbSpacingMain  = match($fbCfg['spacing'] ?? 'normal') {
    'compact'     => '0.5rem',  'comfortable' => '1.5rem',  default => '1rem',
};
$fbSpacingCard  = match($fbCfg['spacing'] ?? 'normal') {
    'compact'     => '0.5rem',  'comfortable' => '1.25rem', default => '1rem',
};
@endphp

{{--
    CSS custom properties — injected on EVERY page unconditionally.
    html.fb-active vars  → used by flowbite-plugin.css (Bootstrap overlay).
    :root vars           → used by flowbite-theme.css (Flowbite sidebar layout).
--}}
<style id="fb-theme-vars">
html.fb-active {
    --fb-primary:       {!! $fbAcc['600'] !!};
    --fb-primary-hover: {!! $fbAcc['700'] !!};
}
:root {
    --fb-brand-500:         {!! $fbAcc['500'] !!};
    --fb-brand-600:         {!! $fbAcc['600'] !!};
    --fb-brand-700:         {!! $fbAcc['700'] !!};
    --fb-sidebar-active-bg: {!! $fbAcc['600'] !!};
    --fb-sidebar-width:     {!! $fbSidebarWidth !!};
    --fb-topbar-height:     {!! $fbTopbarHeight !!};
    --fb-font-size:         {!! $fbFontSize !!};
    --fb-font-family:       {!! $fbStack !!};
    --fb-spacing-nav:       {!! $fbSpacingNav !!};
    --fb-spacing-main:      {!! $fbSpacingMain !!};
    --fb-spacing-card:      {!! $fbSpacingCard !!};
}
</style>

@can('admin')
<a href="{{ url('plugin/FlowbiteTheme') }}" title="Flowbite Modern Theme settings">
    <i class="fa fa-paint-brush fa-fw fa-lg" aria-hidden="true"></i> Flowbite Theme
</a>
@endcan

{{--
  Runs on every page.
  When the user has the Bootstrap overlay enabled (localStorage flag):
    1. Loads the selected Google Font
    2. Loads flowbite-plugin.css
    3. Marks <html> with .fb-active so all CSS rules apply
--}}
<script>
(function () {
    'use strict';

    function addCss(href, id) {
        if (id && document.getElementById(id)) { return; }
        var el = document.createElement('link');
        el.rel  = 'stylesheet';
        el.href = href;
        if (id) { el.id = id; }
        document.head.appendChild(el);
    }

    addCss('{!! $fbFontUrl !!}', 'fb-font');
    addCss('{{ asset('css/flowbite-plugin.css') }}', 'fb-css');

    document.documentElement.classList.add('fb-active');
}());
</script>
