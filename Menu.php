<?php

/*
 * FlowbiteTheme — Menu Hook
 *
 * Adds a "Flowbite Theme" entry in the Plugins dropdown menu and
 * injects the CSS + JS required to activate the sidebar layout on
 * every page (when the user has enabled it via localStorage).
 *
 * Zero core files modified.
 */

namespace App\Plugins\FlowbiteTheme;

use App\Models\Alert;
use App\Plugins\Hooks\MenuEntryHook;
use Illuminate\Support\Facades\View;

class Menu extends MenuEntryHook
{
    /**
     * Register a View Composer for the Flowbite sidebar so the alert count
     * is provided by the service container instead of an inline @php query.
     * This runs during plugin bootstrap — zero core files are modified.
     */
    public function __construct()
    {
        View::composer('layouts.flowbite_sidebar', function (\Illuminate\View\View $view): void {
            if (! $view->offsetExists('alert_count')) {
                $view->with('alert_count', Alert::where('state', '!=', 0)->where('open', 1)->count());
            }
        });
    }

    public function authorize(\Illuminate\Contracts\Auth\Authenticatable $user, array $settings = []): bool
    {
        return true; // visible to every authenticated user (menu link hidden per-role in blade)
    }

    public function data(array $settings = []): array
    {
        return [];
    }
}
