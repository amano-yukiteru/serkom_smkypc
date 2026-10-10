@php
    use App\Helpers\MenuHelper;
    $menuGroups = MenuHelper::getMenuGroups();
    $currentPath = request()->path();
@endphp

<aside id="sidebar"
    class="fixed flex flex-col mt-0 top-0 px-5 start-0 h-screen transition-all duration-300 ease-in-out z-99999 ltr:border-r rtl:border-l w-[90px] [.sidebar-expanded_&]:min-w-[290px]
           bg-[#1E1B7A] border-[#141257] text-white
           dark:bg-[#0e0d33] dark:border-[#141257]"
    x-data="{
        openSubmenus: {},
        init() {
            this.initializeActiveMenus();
        },
        initializeActiveMenus() {
            const currentPath = '{{ $currentPath }}';
            @foreach ($menuGroups as $groupIndex => $menuGroup)
                @foreach ($menuGroup['items'] as $itemIndex => $item)
                    @if (isset($item['subItems']))
                        @foreach ($item['subItems'] as $subItem)
                            if (currentPath === '{{ ltrim($subItem['path'], '/') }}' ||
                                window.location.pathname === '{{ $subItem['path'] }}') {
                                this.openSubmenus['{{ $groupIndex }}-{{ $itemIndex }}'] = true;
                            }
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        },
        toggleSubmenu(groupIndex, itemIndex) {
            const key = groupIndex + '-' + itemIndex;
            const newState = !this.openSubmenus[key];
            if (newState) {
                this.openSubmenus = {};
            }
            this.openSubmenus[key] = newState;
        },
        isSubmenuOpen(groupIndex, itemIndex) {
            const key = groupIndex + '-' + itemIndex;
            return this.openSubmenus[key] || false;
        },
        isActive(path) {
            const current = window.location.pathname;
            return current === path || current.startsWith(path + '/');
        }
    }"
    :class="{
        'translate-x-0': $store.sidebar.isMobileOpen,
        'max-xl:-translate-x-full max-xl:rtl:translate-x-full': !$store.sidebar.isMobileOpen
    }"
    @mouseenter="if (!$store.sidebar.isExpanded) $store.sidebar.setHovered(false)"
    @mouseleave="$store.sidebar.setHovered(false)">

    {{-- ============ LOGO ============ --}}
    <div class="flex items-center gap-3 pt-8 pb-7 transition-all"
        :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen)
            ? 'justify-center'
            : 'justify-start'">

         @if($profil->logo)
            <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo" class="h-8 w-8 rounded object-contain shrink-0">
        @else
            <img src="{{ asset('assets/smkypc.jpeg')}}" alt="Logo" class="h-15 w-15 rounded object-contain shrink-0">
        @endif

        <div class="hidden [.sidebar-expanded_&]:block leading-tight">
            <p class="text-lg font-semibold text-white">{{ $profil->nama_sekolah }}</p>
            <p class="text-sm text-[#B4B8D8]">Tasikmalaya</p>
        </div>
    </div>

    {{-- ============ NAVIGATION ============ --}}
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <nav class="mb-6">
            <div class="flex flex-col gap-4">
                @foreach ($menuGroups as $groupIndex => $menuGroup)
                    @if (count($menuGroup['items']) > 0) 
                        <div>
                            {{-- Group Title --}}
                            <h2 class="mb-4 text-xs uppercase flex leading-[20px] font-semibold tracking-wider text-[#7A7FB0]"
                                :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ?
                                'lg:justify-center' : 'justify-start'">
                                <template x-if="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                                    <span>{{ __($menuGroup['title']) }}</span>
                                </template>
                                <template x-if="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.25 12C4.25 11.5858 4.58579 11.25 5 11.25H19C19.4142 11.25 19.75 11.5858 19.75 12C19.75 12.4142 19.4142 12.75 19 12.75H5C4.58579 12.75 4.25 12.4142 4.25 12Z" fill="currentColor"/>
                                    </svg>
                                </template>
                            </h2>

                            {{-- Menu Items --}}
                            <ul class="flex flex-col gap-1">
                                @foreach ($menuGroup['items'] as $itemIndex => $item)
                                    <li>
                                        @if (isset($item['subItems']))
                                            {{-- ============ DROPDOWN MENU ============ --}}
                                            <button @click="toggleSubmenu({{ $groupIndex }}, {{ $itemIndex }})"
                                                class="group relative flex items-center gap-3 w-full rounded-lg px-3 py-2 text-sm font-medium transition-colors"
                                                :class="[
                                                    isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }})
                                                        ? 'bg-[#1E90D6] text-white'
                                                        : 'text-[#C7CBE8] hover:bg-[#2A2699] hover:text-white',
                                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen)
                                                        ? 'xl:justify-center'
                                                        : 'xl:justify-start'
                                                ]">

                                                {{-- Icon --}}
                                                <span :class="isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }})
                                                    ? 'text-white'
                                                    : 'text-[#A8ADDE] group-hover:text-white'">
                                                    {!! MenuHelper::getIconSvg($item['icon']) !!}
                                                </span>

                                                {{-- Text --}}
                                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                    class="flex items-center gap-2">
                                                    {{ __($item['name']) }}
                                                    @if (!empty($item['new']))
                                                        <span class="absolute ltr:right-10 rtl:left-10 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-[#F5C518] text-[#1E1B7A]">
                                                            {{ __('new') }}
                                                        </span>
                                                    @endif
                                                </span>

                                                {{-- Chevron --}}
                                                {{-- <svg x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                    class="ltr:ml-auto rtl:mr-auto w-5 h-5 transition-transform duration-200"
                                                    :class="isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }})
                                                        ? 'rotate-180 text-white'
                                                        : 'text-[#A8ADDE] group-hover:text-white'"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg> --}}
                                            </button>

                                            {{-- Submenu --}}
                                            <div x-show="isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }}) && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)"
                                                x-collapse>
                                                <ul class="mt-2 space-y-1 ltr:ml-9 rtl:mr-9">
                                                    @foreach ($item['subItems'] as $subItem)
                                                        <li>
                                                            <a href="{{ $subItem['path'] }}"
                                                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors"
                                                                :class="isActive('{{ $subItem['path'] }}')
                                                                    ? 'bg-[#1E90D6]/25 text-white'
                                                                    : 'text-[#C7CBE8] hover:bg-[#2A2699] hover:text-white'">
                                                                {{ __($subItem['name']) }}
                                                                <span class="flex items-center gap-1 ltr:ml-auto rtl:mr-auto">
                                                                    @if (!empty($subItem['new']))
                                                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-[#F5C518] text-[#1E1B7A]">
                                                                            {{ __('new') }}
                                                                        </span>
                                                                    @endif
                                                                    @if (!empty($subItem['pro']))
                                                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-white/20 text-white">
                                                                            {{ __('pro') }}
                                                                        </span>
                                                                    @endif
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <a href="{{ $item['path'] }}"
                                                class="group relative flex items-center gap-3 w-full rounded-lg px-3 py-2 text-sm font-medium transition-colors"
                                                :class="[
                                                    isActive('{{ $item['path'] }}')
                                                        ? 'bg-[#1E90D6] dark:bg-[#2A2699]  text-white'
                                                        : 'text-[#C7CBE8] hover:bg-[#4440b65b] hover:text-white',
                                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen)
                                                        ? 'xl:justify-center'
                                                        : 'xl:justify-start'
                                                ]">

                                                {{-- Icon --}}
                                                <span :class="isActive('{{ $item['path'] }}')
                                                    ? 'text-white'
                                                    : 'text-[#A8ADDE] group-hover:text-white'">
                                                    {!! MenuHelper::getIconSvg($item['icon']) !!}
                                                </span>

                                                {{-- Text --}}
                                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                    class="flex items-center gap-2">
                                                    {{ __($item['name']) }}
                                                    @if (!empty($item['new']))
                                                        <span class="ltr:ml-2 rtl:mr-2 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-[#F5C518] text-[#1E1B7A]">
                                                            {{ __('new') }}
                                                        </span>
                                                    @endif
                                                </span>
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach
            </div>
        </nav>

        {{-- Sidebar Widget --}}
        <div class="hidden [.sidebar-expanded_&]:block mt-auto">
            {{-- @include('layouts.sidebar-widget') --}}
        </div>
    </div>
</aside>