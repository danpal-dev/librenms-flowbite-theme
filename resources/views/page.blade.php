{{-- Flowbite Theme Plugin — Info Page
     Rendered inside layouts.librenmsv1 via plugins.settings.
     This is the inner content only (no @extends needed).
--}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">

            {{-- Header card --}}
            <div class="panel panel-default" style="margin-top: 24px; border-radius: 8px; overflow: hidden;">
                <div class="panel-heading" style="background: linear-gradient(135deg, #1e2432 0%, #2563eb 100%); border: none; padding: 24px;">
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="background: rgba(255,255,255,.15); border-radius: 12px; padding: 12px; flex-shrink: 0;">
                            <i class="fa fa-paint-brush" style="font-size: 24px; color: #fff;" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0 0 4px; color: #fff; font-size: 20px; font-weight: 600;">Flowbite Modern Theme</h2>
                            <p style="margin: 0; color: rgba(255,255,255,.75); font-size: 13px;">
                                Modern visual skin — fuente personalizada, cards refinadas, navbar y dropdowns
                            </p>
                        </div>
                    </div>
                </div>

                <div class="panel-body" style="padding: 24px;">

                    {{-- Status: always active --}}
                    <div class="alert alert-success" style="display: flex; align-items: center; gap: 14px; padding: 16px; border-radius: 8px; margin-bottom: 20px; background: #ecfdf5; border-color: #10b981;">
                        <div style="font-size: 28px; flex-shrink: 0;">
                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                        </div>
                        <div>
                            <strong style="display: block; margin-bottom: 2px;">Flowbite Theme está ACTIVO</strong>
                            <span class="text-muted" style="font-size: 13px;">
                                El tema aplica globalmente a todos los usuarios mientras el plugin esté habilitado.
                                Solo un administrador puede activarlo o desactivarlo desde
                                <a href="{{ route('plugin.admin') }}">Administración de Plugins</a>.
                            </span>
                        </div>
                    </div>

                    @can('admin')
                    <a href="{{ route('plugin.settings', 'FlowbiteTheme') }}" class="btn btn-primary" style="border-radius: 8px; font-weight: 500; padding: 10px 24px;">
                        <i class="fa fa-sliders fa-fw" aria-hidden="true"></i> Personalizar colores y fuente
                    </a>
                    @endcan

                </div>
            </div>

            {{-- Features --}}
            <div class="panel panel-default" style="border-radius: 8px;">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-star fa-fw" aria-hidden="true"></i> Qué hace este tema
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled" style="line-height: 2;">
                                <li><i class="fa fa-check text-success fa-fw" aria-hidden="true"></i> Navbar oscura con colores Flowbite</li>
                                <li><i class="fa fa-check text-success fa-fw" aria-hidden="true"></i> Cards y paneles modernos y redondeados</li>
                                <li><i class="fa fa-check text-success fa-fw" aria-hidden="true"></i> Botones y formularios refinados</li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled" style="line-height: 2;">
                                <li><i class="fa fa-check text-success fa-fw" aria-hidden="true"></i> Compatible con modo oscuro / claro</li>
                                <li><i class="fa fa-check text-success fa-fw" aria-hidden="true"></i> Fuente e tipografía mejorada</li>
                                <li><i class="fa fa-check text-success fa-fw" aria-hidden="true"></i> Sin modificar archivos base de LibreNMS</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
