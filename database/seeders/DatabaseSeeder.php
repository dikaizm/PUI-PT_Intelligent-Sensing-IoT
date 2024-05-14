<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Mitra;
use App\Models\Penelitian;
use App\Models\JenisDokumen;
use App\Models\PublisherKey;
use App\Models\StatusOutput;
use App\Models\JenisPenelitian;
use Illuminate\Database\Seeder;
use App\Models\StatusPenelitian;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'mengelola-pengguna']);
        Permission::create(['name' => 'mengelola-pengaturan']);

        $role1 = Role::create(['name' => 'Admin']);
        $role1->givePermissionTo('mengelola-pengguna');
        $role1->givePermissionTo('mengelola-pengaturan');

        $role2 = Role::create(['name' => 'Dosen']);

        $role3 = Role::create(['name' => 'Kaur']);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Dosen',
            'email' => 'dosen@example.com',
            'password' => 'dosen',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Kepala Koor',
            'email' => 'kaur@example.com',
            'password' => 'kaur',
        ]);
        $user->assignRole($role3);

        DB::table('status_penelitian_key')->insert([
            'name' => 'Proposal',
        ]);
        DB::table('status_penelitian_key')->insert([
            'name' => 'Pelaksanaan',
        ]);
        DB::table('status_penelitian')->insert([
            'status_penelitian_key_id' => '1',
            'name' => 'Menyusun',
        ]);
        DB::table('status_penelitian')->insert([
            'status_penelitian_key_id' => '1',
            'name' => 'Disetujui',
        ]);
        DB::table('status_penelitian')->insert([
            'status_penelitian_key_id' => '1',
            'name' => 'Ditolak',
        ]);
        DB::table('status_penelitian')->insert([
            'status_penelitian_key_id' => '2',
            'name' => 'Pendanaan',
        ]);

        DB::table('jenis_penelitian')->insert([
            'name' => 'Internal Telkom',
        ]);
        DB::table('jenis_penelitian')->insert([
            'name' => 'Eksternal Telkom',
        ]);

        Mitra::factory()->count(9)->create();
        User::factory()->count(10)->create();
        PublisherKey::factory()->count(3)->create();
        JenisPenelitian::factory()->count(10)->create();
        StatusPenelitian::factory()->count(10)->create();
        StatusOutput::factory()->count(3)->create();
        JenisDokumen::factory()->count(3)->create();
        Penelitian::factory()->count(5)->create();

        DB::table('publisher')->insert([
            'publisher_key_id' => '1',
            'tingkat_index' => '1',
        ]);
        DB::table('publisher')->insert([
            'publisher_key_id' => '1',
            'tingkat_index' => '2',
        ]);
        DB::table('publisher')->insert([
            'publisher_key_id' => '1',
            'tingkat_index' => '3',
        ]);
        DB::table('publisher')->insert([
            'publisher_key_id' => '2',
            'tingkat_index' => '1',
        ]);
        DB::table('publisher')->insert([
            'publisher_key_id' => '2',
            'tingkat_index' => '2',
        ]);
        DB::table('publisher')->insert([
            'publisher_key_id' => '2',
            'tingkat_index' => '3',
        ]);
        DB::table('publisher')->insert([
            'publisher_key_id' => '3',
            'tingkat_index' => '1',
        ]);
        DB::table('publisher')->insert([
            'publisher_key_id' => '3',
            'tingkat_index' => '2',
        ]);
        DB::table('publisher')->insert([
            'publisher_key_id' => '3',
            'tingkat_index' => '3',
        ]);

        DB::table('author')->insert([
            'penelitian_id' => '1',
            'user_id' => '2',
        ]);
        DB::table('author')->insert([
            'penelitian_id' => '1',
            'user_id' => '5',
        ]);
        DB::table('author')->insert([
            'penelitian_id' => '2',
            'user_id' => '6',
        ]);
        DB::table('author')->insert([
            'penelitian_id' => '2',
            'user_id' => '7',
        ]);
        DB::table('author')->insert([
            'penelitian_id' => '3',
            'user_id' => '8',
        ]);
        DB::table('author')->insert([
            'penelitian_id' => '3',
            'user_id' => '9',
        ]);
        DB::table('author')->insert([
            'penelitian_id' => '4',
            'user_id' => '10',
        ]);
        DB::table('author')->insert([
            'penelitian_id' => '4',
            'user_id' => '11',
        ]);
        DB::table('author')->insert([
            'penelitian_id' => '5',
            'user_id' => '12',
        ]);
        DB::table('author')->insert([
            'penelitian_id' => '5',
            'user_id' => '13',
        ]);
    }
}
