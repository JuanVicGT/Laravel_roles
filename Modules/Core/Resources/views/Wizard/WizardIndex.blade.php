@php
    $pages_no = 1;
    $permissions_no = 1;
@endphp

<x-app-layout path="layouts.app" :tab_title="__('Wizard')">

    {{-- Tabs Header --}}
    <div x-data="{ selectedTab: 'page-permissions' }" class="w-full">
        <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()"
            class="flex gap-2 overflow-x-auto border-b border-outline dark:border-outline-dark" role="tablist"
            aria-label="tab options">

            {{-- Pages Permissions Tab --}}
            <button x-on:click="selectedTab = 'page-permissions'"
                x-bind:aria-selected="selectedTab === 'page-permissions'"
                x-bind:tabindex="selectedTab === 'page-permissions' ? '0' : '-1'"
                x-bind:class="selectedTab === 'page-permissions' ?
                    'font-bold text-primary border-b-2 border-primary dark:border-primary-dark dark:text-primary-dark' :
                    'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
                class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab"
                aria-controls="tabpanelPagesPermissions">
                <i class="fa-solid fa-file-shield"></i>
                {{ __('Page Permissions') }}
            </button>

            {{-- Extra Permissions Tab --}}
            <button x-on:click="selectedTab = 'extra-permissions'"
                x-bind:aria-selected="selectedTab === 'extra-permissions'"
                x-bind:tabindex="selectedTab === 'extra-permissions' ? '0' : '-1'"
                x-bind:class="selectedTab === 'extra-permissions' ?
                    'font-bold text-primary border-b-2 border-primary dark:border-primary-dark dark:text-primary-dark' :
                    'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
                class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab"
                aria-controls="tabpanelExtraPermissions">
                <i class="fa-solid fa-user-shield"></i>
                {{ __('Extra Permissions') }}
            </button>

            {{-- Menu Navigation Tab --}}
            <button x-on:click="selectedTab = 'menu-navigation'"
                x-bind:aria-selected="selectedTab === 'menu-navigation'"
                x-bind:tabindex="selectedTab === 'menu-navigation' ? '0' : '-1'"
                x-bind:class="selectedTab === 'menu-navigation' ?
                    'font-bold text-primary border-b-2 border-primary dark:border-primary-dark dark:text-primary-dark' :
                    'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
                class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab"
                aria-controls="tabpanelMenuNavigation">
                <i class="fa-solid fa-map"></i>
                {{ __('Menu Navigation') }}
            </button>
        </div>

        {{-- Tabs Content --}}
        <div class="px-2 py-4 text-on-surface dark:text-on-surface-dark">

            {{-- Creación de permisos de página (principales) --}}
            <div x-cloak x-show="selectedTab === 'page-permissions'" id="tabpanelPagesPermissions" role="tabpanel"
                aria-label="pages">
                <livewire:permiso_pagina />
            </div>

            {{-- Creación de permisos extras --}}
            <div x-cloak x-show="selectedTab === 'extra-permissions'" id="tabpanelExtraPermissions" role="tabpanel"
                aria-label="extras">
                <livewire:permiso_extra />
            </div>

            {{-- Menu Navigation --}}
            <div x-cloak x-show="selectedTab === 'menu-navigation'" id="tabpanelMenuNavigation" role="tabpanel"
                aria-label="menu-navigation">
                <livewire:menu_navegacion />
            </div>
        </div>
    </div>

</x-app-layout>
