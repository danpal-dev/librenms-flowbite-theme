{{--
  FlowbiteTheme — Admin Settings
  Shown at /plugin/settings/FlowbiteTheme (admin only).
  POSTs to route('plugin.update', 'FlowbiteTheme').
--}}
@php
    // Read directly from DB — bypasses the SettingsHook double-call
    // pattern so we always show the actually saved values.
    $s        = \App\Plugins\FlowbiteTheme\Settings::getSettings();
    $accent   = $s['accent_color']  ?? 'blue';
    $sidebar  = $s['sidebar_width'] ?? 'normal';
    $topbar   = $s['topbar_height'] ?? 'normal';
    $fontsize = $s['font_size']     ?? 'normal';
    $spacing  = $s['spacing']       ?? 'normal';
    $fontfam  = $s['font_family']   ?? 'inter';

    $accents = [
        'blue'    => ['label' => 'Azul',      'hex' => '#2563eb'],
        'indigo'  => ['label' => 'Índigo',    'hex' => '#4f46e5'],
        'violet'  => ['label' => 'Violeta',   'hex' => '#7c3aed'],
        'emerald' => ['label' => 'Esmeralda', 'hex' => '#059669'],
        'teal'    => ['label' => 'Teal',      'hex' => '#0d9488'],
        'cyan'    => ['label' => 'Cian',      'hex' => '#0891b2'],
        'rose'    => ['label' => 'Rosa',      'hex' => '#e11d48'],
        'amber'   => ['label' => 'Ámbar',     'hex' => '#d97706'],
    ];

    $fonts = [
        'inter'     => ['label' => 'Inter',          'stack' => "'Inter', sans-serif",              'sample' => 'Inter'],
        'geist'     => ['label' => 'Geist',           'stack' => "'Geist', sans-serif",              'sample' => 'Geist'],
        'roboto'    => ['label' => 'Roboto',          'stack' => "'Roboto', sans-serif",             'sample' => 'Roboto'],
        'dm_sans'   => ['label' => 'DM Sans',         'stack' => "'DM Sans', sans-serif",            'sample' => 'DM Sans'],
        'jetbrains' => ['label' => 'JetBrains Mono',  'stack' => "'JetBrains Mono', monospace",      'sample' => 'JetBrains'],
    ];
@endphp

<style>
.fb-settings-wrap      { max-width: 780px; margin: 24px auto; }
.fb-swatch-row         { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
.fb-swatch             { width: 38px; height: 38px; border-radius: 50%; cursor: pointer;
                          border: 3px solid transparent; transition: transform .15s, border-color .15s;
                          position: relative; }
.fb-swatch:hover        { transform: scale(1.15); }
.fb-swatch.active       { border-color: #111; box-shadow: 0 0 0 2px #fff inset; }
.dark .fb-swatch.active { border-color: #fff; }
.fb-swatch-label        { font-size: 11px; color: #6b7280; text-align: center; margin-top: 4px; }
.fb-option-card         { display: flex; flex-direction: column; align-items: center; gap: 4px;
                          cursor: pointer; }
.fb-option-btn          { padding: 8px 22px; border-radius: 8px; border: 2px solid #e5e7eb;
                          background: #fff; font-size: 13px; font-weight: 500; cursor: pointer;
                          transition: border-color .15s, background .15s; color: #374151; }
.fb-option-btn:hover    { border-color: #9ca3af; }
.fb-option-btn.active   { border-color: var(--accent-hex, #2563eb);
                          background: color-mix(in srgb, var(--accent-hex, #2563eb) 10%, white);
                          color: var(--accent-hex, #2563eb); }
.fb-section-title       { font-weight: 600; font-size: 14px; margin-bottom: 4px; color: #111827; }
.fb-section-desc        { font-size: 12px; color: #6b7280; margin-bottom: 12px; }
</style>

<div class="fb-settings-wrap" id="fb-settings-root">

    <form method="POST" action="{{ route('plugin.update', $plugin_name) }}" id="fb-settings-form">
        @csrf
        @method('POST')
        <input type="hidden" name="plugin_active" value="1">
        <input type="hidden" name="settings[accent_color]"  id="inp-accent"   value="{{ $accent }}">
        <input type="hidden" name="settings[sidebar_width]" id="inp-sidebar"  value="{{ $sidebar }}">
        <input type="hidden" name="settings[topbar_height]" id="inp-topbar"   value="{{ $topbar }}">
        <input type="hidden" name="settings[font_size]"     id="inp-fontsize" value="{{ $fontsize }}">
        <input type="hidden" name="settings[spacing]"       id="inp-spacing"  value="{{ $spacing }}">
        <input type="hidden" name="settings[font_family]"   id="inp-fontfam"  value="{{ $fontfam }}">

        {{-- Header --}}
        <div class="panel panel-default" style="border-radius: 10px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.08);">
            <div class="panel-heading" style="background: linear-gradient(135deg, #1e2432 0%, #2563eb 100%); padding: 20px 24px; border: none;">
                <div style="display:flex; align-items:center; gap:14px;">
                    <div style="background:rgba(255,255,255,.15); border-radius:10px; padding:10px;">
                        <i class="fa fa-paint-brush" style="font-size:22px; color:#fff;"></i>
                    </div>
                    <div>
                        <div style="font-size:17px; font-weight:700; color:#fff;">Personalización · Flowbite Theme</div>
                        <div style="font-size:12px; color:rgba(255,255,255,.7); margin-top:2px;">Los cambios se aplican globalmente para todos los usuarios.</div>
                    </div>
                </div>
            </div>

            <div class="panel-body" style="padding: 24px;">

                {{-- ── Color de acento ── --}}
                <div style="margin-bottom: 28px;">
                    <div class="fb-section-title"><i class="fa fa-circle fa-fw" style="color: var(--fb-brand-600, #2563eb);"></i> Color de acento</div>
                    <div class="fb-section-desc">Define el color primario del sidebar activo, botones y highlights.</div>
                    <div class="fb-swatch-row">
                        @foreach($accents as $key => $info)
                            <div class="fb-option-card">
                                <div class="fb-swatch {{ $accent === $key ? 'active' : '' }}"
                                     style="background: {{ $info['hex'] }};"
                                     data-accent="{{ $key }}"
                                     title="{{ $info['label'] }}">
                                </div>
                                <div class="fb-swatch-label">{{ $info['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr style="margin: 0 0 24px;">

                {{-- ── Familia tipográfica ── --}}
                <div style="margin-bottom: 28px;">
                    <div class="fb-section-title"><i class="fa fa-font fa-fw"></i> Familia tipográfica</div>
                    <div class="fb-section-desc">Fuente usada en toda la interfaz: sidebar, tablas, contenido.</div>
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top: 8px;">
                        @foreach($fonts as $key => $info)
                            <button type="button"
                                    class="fb-option-btn {{ $fontfam === $key ? 'active' : '' }}"
                                    data-fontfam="{{ $key }}"
                                    style="font-family: {{ $info['stack'] }};">
                                {{ $info['sample'] }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <hr style="margin: 0 0 24px;">

                {{-- ── Tamaño de texto ── --}}
                <div style="margin-bottom: 28px;">
                    <div class="fb-section-title"><i class="fa fa-text-height fa-fw"></i> Tamaño de texto</div>
                    <div class="fb-section-desc">Afecta el cuerpo de texto, tablas y etiquetas del sidebar.</div>
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top: 8px;">
                        <button type="button" class="fb-option-btn {{ $fontsize === 'small' ? 'active' : '' }}"
                                data-fontsize="small" style="font-size:11px;">
                            <i class="fa fa-minus-circle fa-fw"></i> Pequeño <small class="text-muted">(12px)</small>
                        </button>
                        <button type="button" class="fb-option-btn {{ $fontsize === 'normal' ? 'active' : '' }}"
                                data-fontsize="normal" style="font-size:13px;">
                            <i class="fa fa-font fa-fw"></i> Normal <small class="text-muted">(13px)</small>
                        </button>
                        <button type="button" class="fb-option-btn {{ $fontsize === 'large' ? 'active' : '' }}"
                                data-fontsize="large" style="font-size:15px;">
                            <i class="fa fa-plus-circle fa-fw"></i> Grande <small class="text-muted">(14px)</small>
                        </button>
                    </div>
                </div>

                <hr style="margin: 0 0 24px;">

                {{-- ── Espaciado ── --}}
                <div style="margin-bottom: 28px;">
                    <div class="fb-section-title"><i class="fa fa-th-large fa-fw"></i> Densidad / Espaciado</div>
                    <div class="fb-section-desc">Controla el padding del contenido principal, nav items y cards.</div>
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top: 8px;">
                        <button type="button" class="fb-option-btn {{ $spacing === 'compact' ? 'active' : '' }}"
                                data-spacing="compact">
                            <i class="fa fa-compress fa-fw"></i> Compacto
                        </button>
                        <button type="button" class="fb-option-btn {{ $spacing === 'normal' ? 'active' : '' }}"
                                data-spacing="normal">
                            <i class="fa fa-square fa-fw"></i> Normal
                        </button>
                        <button type="button" class="fb-option-btn {{ $spacing === 'comfortable' ? 'active' : '' }}"
                                data-spacing="comfortable">
                            <i class="fa fa-expand fa-fw"></i> Cómodo
                        </button>
                    </div>
                </div>

                <hr style="margin: 0 0 24px;">

                {{-- ── Ancho del sidebar ── --}}
                <div style="margin-bottom: 28px;">
                    <div class="fb-section-title"><i class="fa fa-columns fa-fw"></i> Ancho del sidebar</div>
                    <div class="fb-section-desc">Normal muestra etiquetas completas. Compacto libera más espacio.</div>
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top: 8px;">
                        <button type="button" class="fb-option-btn {{ $sidebar === 'normal' ? 'active' : '' }}"
                                data-sidebar="normal">
                            <i class="fa fa-arrows-h fa-fw"></i> Normal <small class="text-muted">(220px)</small>
                        </button>
                        <button type="button" class="fb-option-btn {{ $sidebar === 'compact' ? 'active' : '' }}"
                                data-sidebar="compact">
                            <i class="fa fa-compress fa-fw"></i> Compacto <small class="text-muted">(180px)</small>
                        </button>
                    </div>
                </div>

                <hr style="margin: 0 0 24px;">

                {{-- ── Altura de la topbar ── --}}
                <div style="margin-bottom: 28px;">
                    <div class="fb-section-title"><i class="fa fa-window-maximize fa-fw"></i> Altura de la barra superior</div>
                    <div class="fb-section-desc">Compacto reduce la barra superior para maximizar el espacio vertical.</div>
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top: 8px;">
                        <button type="button" class="fb-option-btn {{ $topbar === 'normal' ? 'active' : '' }}"
                                data-topbar="normal">
                            <i class="fa fa-minus fa-fw"></i> Normal <small class="text-muted">(48px)</small>
                        </button>
                        <button type="button" class="fb-option-btn {{ $topbar === 'compact' ? 'active' : '' }}"
                                data-topbar="compact">
                            <i class="fa fa-compress fa-fw"></i> Compacto <small class="text-muted">(40px)</small>
                        </button>
                    </div>
                </div>

                {{-- ── Save ── --}}
                <div style="display:flex; justify-content:flex-end; gap:10px; margin-top: 8px;">
                    <a href="{{ route('plugin.admin') }}" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary" id="fb-save-btn">
                        <i class="fa fa-save fa-fw"></i> Guardar cambios
                    </button>
                </div>

            </div>
        </div>

    </form>

    <div style="text-align:center; font-size:12px; color:#9ca3af; margin-top: 8px;">
        <i class="fa fa-info-circle"></i>
        Los cambios se aplican tras recargar la página.
    </div>

</div>

<script>
(function () {
    'use strict';

    var accentHex = @json(collect($accents)->pluck('hex', null)->toArray());
    var currentAccent = '{{ $accent }}';

    function updateAccentPreview(key) {
        document.getElementById('fb-settings-root').style.setProperty('--accent-hex', accentHex[key] || '#2563eb');
    }

    // ── Accent swatches ──
    document.querySelectorAll('.fb-swatch[data-accent]').forEach(function (el) {
        el.addEventListener('click', function () {
            document.querySelectorAll('.fb-swatch').forEach(function (s) { s.classList.remove('active'); });
            el.classList.add('active');
            document.getElementById('inp-accent').value = el.dataset.accent;
            updateAccentPreview(el.dataset.accent);
        });
    });

    // ── Font family buttons ──
    document.querySelectorAll('.fb-option-btn[data-fontfam]').forEach(function (el) {
        el.addEventListener('click', function () {
            document.querySelectorAll('.fb-option-btn[data-fontfam]').forEach(function (b) { b.classList.remove('active'); });
            el.classList.add('active');
            document.getElementById('inp-fontfam').value = el.dataset.fontfam;
        });
    });

    // ── Font size buttons ──
    document.querySelectorAll('.fb-option-btn[data-fontsize]').forEach(function (el) {
        el.addEventListener('click', function () {
            document.querySelectorAll('.fb-option-btn[data-fontsize]').forEach(function (b) { b.classList.remove('active'); });
            el.classList.add('active');
            document.getElementById('inp-fontsize').value = el.dataset.fontsize;
        });
    });

    // ── Spacing buttons ──
    document.querySelectorAll('.fb-option-btn[data-spacing]').forEach(function (el) {
        el.addEventListener('click', function () {
            document.querySelectorAll('.fb-option-btn[data-spacing]').forEach(function (b) { b.classList.remove('active'); });
            el.classList.add('active');
            document.getElementById('inp-spacing').value = el.dataset.spacing;
        });
    });

    // ── Sidebar option buttons ──
    document.querySelectorAll('.fb-option-btn[data-sidebar]').forEach(function (el) {
        el.addEventListener('click', function () {
            document.querySelectorAll('.fb-option-btn[data-sidebar]').forEach(function (b) { b.classList.remove('active'); });
            el.classList.add('active');
            document.getElementById('inp-sidebar').value = el.dataset.sidebar;
        });
    });

    // ── Topbar option buttons ──
    document.querySelectorAll('.fb-option-btn[data-topbar]').forEach(function (el) {
        el.addEventListener('click', function () {
            document.querySelectorAll('.fb-option-btn[data-topbar]').forEach(function (b) { b.classList.remove('active'); });
            el.classList.add('active');
            document.getElementById('inp-topbar').value = el.dataset.topbar;
        });
    });

    // Init preview
    updateAccentPreview(currentAccent);
}());
</script>
