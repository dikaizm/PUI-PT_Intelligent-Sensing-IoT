<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Skema;
use App\Models\Penelitian;
use App\Models\JenisOutput;
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
        Permission::create(['name' => 'update-feedback']);

        $role1 = Role::create(['name' => 'Admin']);
        $role1->givePermissionTo('mengelola-pengguna');
        $role1->givePermissionTo('mengelola-pengaturan');
        $role1->givePermissionTo('update-feedback');

        $role2 = Role::create(['name' => 'Dosen']);

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
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'john',
        ]);
        $user->assignRole($role2);

        DB::table('status_output')->insert([
            'name' => 'Tidak Ada',
        ]);
        DB::table('status_penelitian_key')->insert([
            'name' => 'Tidak Ada',
        ]);
        DB::table('status_penelitian')->insert([
            'status_penelitian_key' => '1',
            'name' => 'NONE',
        ]);

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

        User::factory()->count(10)->create();
        JenisPenelitian::factory()->count(10)->create();
        StatusPenelitian::factory()->count(10)->create();
        StatusOutput::factory()->count(3)->create();
        Skema::factory()->count(9)->create();
        Penelitian::factory()->count(5)->create();

        DB::table('jenis_output_key')->insert([
            'name' => 'Publikasi',
        ]);
        DB::table('jenis_output_key')->insert([
            'name' => 'HKI',
        ]);
        DB::table('jenis_output_key')->insert([
            'name' => 'Foto/Poster',
        ]);
        DB::table('jenis_output_key')->insert([
            'name' => 'Video',
        ]);
        JenisOutput::factory()->count(3)->create();

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

        DB::table('output')->insert([
            'penelitian_id' => '1',
        ]);
        DB::table('output_detail')->insert([
            'output_id' => '1',
            'jenis_output_id' => '1',
            'status_output_id' => '1',
            'judul' => 'seeders',
            'tautan' => 'seeders',
            'file' => 'public',
        ]);
        DB::table('output_detail')->insert([
            'output_id' => '1',
            'jenis_output_id' => '2',
            'status_output_id' => '1',
            'judul' => 'seeders',
            'tautan' => 'seeders',
            'file' => 'public',
        ]);
        DB::table('output_detail')->insert([
            'output_id' => '1',
            'jenis_output_id' => '3',
            'status_output_id' => '1',
            'judul' => 'seeders',
            'tautan' => 'seeders',
            'file' => 'public',
        ]);
        DB::table('register_keys')->insert([
            'key' => '123456789abcd',
        ]);
    }
}
