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

### 1. Clonar el repositorio

```bash
cd /opt/librenms/app/Plugins
git clone https://github.com/danpal-dev/librenms-flowbite-theme.git FlowbiteTheme
```

### 2. Corregir permisos

```bash
chown -R librenms:librenms /opt/librenms/app/Plugins/FlowbiteTheme
```

### 3. Activar el plugin en LibreNMS

1. Inicia sesión en LibreNMS como administrador.
2. Ve a **Configuración → Plugins** (o accede directamente a `/plugins`).
3. Busca **FlowbiteTheme** en la lista y haz clic en **Enable**.

### 4. Activar el tema por usuario

Una vez activado el plugin, cada usuario puede habilitar o deshabilitar el tema desde:

**Menú → Plugins → Flowbite Theme**

O accediendo directamente a `/plugin/FlowbiteTheme`.

### Actualizar

```bash
cd /opt/librenms/app/Plugins/FlowbiteTheme
git pull
```

### Desinstalar

1. Desactiva el plugin desde **Configuración → Plugins**.
2. Elimina la carpeta:

```bash
rm -rf /opt/librenms/app/Plugins/FlowbiteTheme
```

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

## Autor

**danpal-dev**
- GitHub: [@danpal-dev](https://github.com/danpal-dev)

---

## Licencia

MIT
