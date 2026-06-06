# FlowbiteTheme — Plugin para LibreNMS

Un plugin que reemplaza el layout clásico de LibreNMS por un diseño moderno basado en [Flowbite](https://flowbite.com/) (Tailwind CSS), con barra lateral rediseñada, topbar y amplia personalización visual. **No modifica ningún archivo del núcleo de LibreNMS.**

---

## Características

- **Sidebar moderno** con navegación colapsable, acceso rápido a alertas activas y soporte para modo oscuro.
- **Topbar** configurable en altura.
- **Color de acento** seleccionable: Azul, Índigo, Violeta, Esmeralda, Teal, Cian, Rosa, Ámbar.
- **Ancho de sidebar** ajustable: normal, ancho o compacto.
- **Tamaño de fuente y espaciado** configurables desde el panel de administración.
- **Familia tipográfica** seleccionable: Inter, Geist, Roboto, DM Sans, JetBrains Mono.
- Activación/desactivación por usuario desde la página `/plugin/FlowbiteTheme`.
- Ajustes globales de administrador en `/plugin/settings/FlowbiteTheme`.

---

## Instalación

```bash
cd /opt/librenms/app/Plugins
git clone https://github.com/danpal-dev/librenms-flowbite-theme.git FlowbiteTheme
```

Luego ve a **LibreNMS → Plugins** y activa **FlowbiteTheme**.

---

## Configuración

Una vez activado, los administradores pueden ir a:

**Plugins → FlowbiteTheme → Settings**

Y configurar:

| Opción | Descripción |
|---|---|
| Accent color | Color principal de la interfaz |
| Sidebar width | Ancho de la barra lateral |
| Topbar height | Altura de la barra superior |
| Font size | Tamaño de fuente global |
| Spacing | Densidad del espaciado |
| Font family | Tipografía utilizada |

---

## Requisitos

- LibreNMS con soporte de plugins (sistema de hooks `app/Plugins`).
- PHP 8.1+

---

## Licencia

MIT
