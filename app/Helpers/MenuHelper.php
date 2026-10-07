<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class MenuHelper
{
    public static function getMainNavItems(): array
    {
        return [
            [
                'icon' => 'dashboard',
                'name' => 'Dashboard',
                'path' => '/dashboard',
                'roles' => ['Admin', 'Oprator'],
            ], [
                'icon' => 'newspaper',
                'name' => 'Berita',
                'path' => '/berita',
                'roles' => ['Admin', 'Oprator'],
            ], [
                'icon' => 'graduation-cap',
                'name' => 'Siswa',
                'path' => '/siswa',
                'roles' => ['Admin', 'Oprator'],
            ], [
                'icon' => 'chalkboard',
                'name' => 'Guru',
                'path' => '/guru',
                'roles' => ['Admin', 'Oprator'],
            ], [
                'icon' => 'trophy',
                'name' => 'Ekstrakurikuler',
                'path' => '/ekstrakurikuler',
                'roles' => ['Admin', 'Oprator'],
            ],
        ];
    }

    public static function getOthersItems()
    {
        return [
            [
                'icon'  => 'photo',
                'name'  => 'Galeri',
                'path'  => '/galeri',              // ← FIX
                'roles' => ['Admin', 'Oprator'],
            ],
            [
                'icon'  => 'school',
                'name'  => 'Profil Sekolah',
                'path'  => '/profil-sekolah/index',
                'roles' => ['Admin', 'Oprator'],
            ],
            [
                'icon'  => 'users-group',
                'name'  => 'Manajemen User',
                'path'  => '/user',
                'roles' => ['Admin'],
            ],
        ];
    }

    public static function getMenuGroups()
    {
        $userRole = Auth::user()?->role;

        return [
            [
                'title' => 'Menu Utama',
                'items' => self::filterByRole(self::getMainNavItems(), $userRole),
            ],
            [
                'title' => 'Pengaturan',
                'items' => self::filterByRole(self::getOthersItems(), $userRole),
            ],
        ];
    }

    private static function filterByRole(array $items, ?string $role): array
    {
        if (! $role) {
            return [];
        }

        return array_values(array_filter($items, function ($item) use ($role) {
            if (empty($item['roles'])) {
                return true;
            }

            $allowed = array_map('strtolower', $item['roles']);

            return in_array(strtolower($role), $allowed, true);
        }));
    }

    public static function isActive(string $path): bool
    {
        $current = '/'.ltrim(request()->path(), '/');

        if ($path === '/') {
            return $current === '/';
        }

        return $current === $path || str_starts_with($current, $path.'/');
    }

    public static function getIconSvg(string $iconName): string
    {
        $icons = [
            'dashboard'       => '<i class="fa-solid fa-house text-lg"></i>',
            'newspaper'       => '<i class="fa-solid fa-newspaper text-lg"></i>',
            'graduation-cap'  => '<i class="fa-solid fa-graduation-cap text-lg"></i>',
            'chalkboard'      => '<i class="fa-solid fa-chalkboard-user text-lg"></i>',
            'trophy'          => '<i class="fa-solid fa-trophy text-lg"></i>',
            'photo'           => '<i class="fa-solid fa-image text-lg"></i>',
            'school'          => '<i class="fa-solid fa-school text-lg"></i>',
            'users-group'     => '<i class="fa-solid fa-users text-lg"></i>',
        ];

        return $icons[$iconName] ?? '<i class="fa-solid fa-circle-question text-lg"></i>';
    }
}
