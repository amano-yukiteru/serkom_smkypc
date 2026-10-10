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
                'icon' => 'student',
                'name' => 'Siswa',
                'path' => '/siswa',
                'roles' => ['Admin', 'Oprator'],
            ], [
                'icon' => 'teacher',
                'name' => 'Guru',
                'path' => '/guru',
                'roles' => ['Admin', 'Oprator'],
            ], [
                'icon' => 'trophy',
                'name' => 'Ekstrakurikuler',
                'path' => '/ekstrakurikuler',
                'roles' => ['Admin', 'Oprator'],
            ], [
                'icon' => 'major',
                'name' => 'Jurusan',
                'path' => '/jurusan',
                'roles' => ['Admin', 'Oprator'],
            ],
        ];
    }

    public static function getOthersItems()
    {
        return [
            [
                'icon' => 'gallery',
                'name' => 'Galeri',
                'path' => '/galeri',
                'roles' => ['Admin', 'Oprator'],
            ],
            [
                'icon' => 'partnership',        // ⬅️ BARU
                'name' => 'Kerjasama',          // ⬅️ BARU
                'path' => '/kerjasama',         // ⬅️ BARU
                'roles' => ['Admin', 'Oprator'],// ⬅️ BARU
            ],
            [
                'icon' => 'school',
                'name' => 'Profil Sekolah',
                'path' => '/profil-sekolah/index',
                'roles' => ['Admin', 'Oprator'],
            ],
            [
                'icon' => 'user-management',
                'name' => 'Manajemen User',
                'path' => '/user',
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
            'student'         => '<i class="fa-solid fa-user-graduate text-lg"></i>',
            'teacher'         => '<i class="fa-solid fa-chalkboard-user text-lg"></i>',
            'trophy'          => '<i class="fa-solid fa-trophy text-lg"></i>',
            'major'           => '<i class="fa-solid fa-book-open text-lg"></i>',
            'gallery'         => '<i class="fa-solid fa-images text-lg"></i>',
            'partnership'     => '<i class="fa-solid fa-handshake text-lg"></i>',   // ⬅️ BARU
            'school'          => '<i class="fa-solid fa-school text-lg"></i>',
            'user-management' => '<i class="fa-solid fa-users-gear text-lg"></i>',
        ];

        return $icons[$iconName] ?? '<i class="fa-solid fa-circle-question text-lg"></i>';
    }
}