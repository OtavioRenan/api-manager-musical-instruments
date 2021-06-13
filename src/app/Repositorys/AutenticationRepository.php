<?php
declare(strict_types=1);

namespace App\Repositorys;

class AutenticationRepository
{
    protected $model;

    public function __construct(\App\Models\UserModel $userModel)
    {
        $this->model = $userModel;
    }

    public function getWhere(array $input)
    {
        return $this->model->where('user_login', '=', $input['user_login'])->first();
    }
}
