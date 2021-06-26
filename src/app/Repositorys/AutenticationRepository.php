<?php
declare(strict_types=1);

namespace App\Repositorys;

use App\Models\AuthModel;

class AutenticationRepository
{
    protected $model;

    protected $fields = [
        'name',
        'login',
        'password'
    ];

    public function __construct(AuthModel $authModel)
    {
        $this->model = $authModel;
    }

    public function getWhere(string $input) : AuthModel
    {
        return $this->model->where('login', '=', $input)->first();
    }

    public function register(array $input) : AuthModel
    {
        foreach ($this->fields as $field)
        {
            if (isset($input[$field]))
            {
                $this->model->{$field} = $input[$field];
            }
        }

        $this->model->save();

        return $this->model;
    }
}
