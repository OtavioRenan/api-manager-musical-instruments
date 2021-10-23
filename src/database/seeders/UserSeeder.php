<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new \App\Models\AuthModel();

        $model->id = 1;
        $model->name = 'ADMINISTRADOR';
        $model->login = 'admin';
        $model->password = bcrypt('admin');

        $model->save();
    }
}
