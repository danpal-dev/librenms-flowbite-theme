<?php

/*
 * FlowbiteTheme — Page Hook
 *
 * Renders the theme-toggle page at /plugin/FlowbiteTheme.
 * Users can enable or disable the Flowbite sidebar layout from here.
 */

namespace App\Plugins\FlowbiteTheme;

use App\Plugins\Hooks\PageHook;
use App\Models\User;

class Page extends PageHook
{
    public function authorize(User $user): bool
    {
        return true; // visible for all users (admin link to settings shown via @can)
    }

    public function data(): array
    {
        return [
            'title' => 'Flowbite Modern Theme',
        ];
    }
}
