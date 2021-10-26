<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'ADMINISTRADOR',
            'login' => 'admin',
            'password' => bcrypt('admin')
        ]);

        /* Não roda usando a trait como sistema de log
        $model = new \App\Models\AuthModel();
        $model->id = 1;
        $model->name = 'ADMINISTRADOR';
        $model->login = 'admin';
        $model->password = bcrypt('admin');
        $model->save();
        */
    }
}
