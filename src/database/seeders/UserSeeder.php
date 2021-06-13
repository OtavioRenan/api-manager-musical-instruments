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
        $model = new \App\Main\User\Model\UserModel();

        $model->user_name = 'ADMINISTRADOR';
        $model->user_login = 'admin';
        $model->user_password = \Illuminate\Support\Facades\Hash::make('admin');

        $model->save();
    }
}
