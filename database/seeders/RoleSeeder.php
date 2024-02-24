<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert($this->adminRoleData());
    }

    private function adminRoleData(): array
    {
        return [
            'id' => 1,
            'name' => 'admin',
            'slug' => 'admin',
            'permissions' => json_encode([
                'platform.index' => '1',
                'platform.goods.edit' => '1',
                'platform.goods.list' => '1',
                'platform.items.edit' => '1',
                'platform.items.list' => '1',
                'platform.orders.edit' => '1',
                'platform.orders.list' => '1',
                'platform.goods.create' => '1',
                'platform.items.create' => '1',
                'platform.orders.create' => '1',
                'platform.systems.roles' => '1',
                'platform.systems.users' => '1',
                'platform.goodTypes.edit' => '1',
                'platform.goodTypes.list' => '1',
                'platform.goodTypes.create' => '1',
                'platform.systems.attachment' => '1',
            ]),
            'created_at' => '2024-02-25 03:09:18',
            'updated_at' => '2024-02-25 03:09:18',
        ];
    }
}