<?php
declare(strict_types=1);

namespace App\Repositorys;

use App\Models\UserModel;
use Illuminate\Support\Collection;

class UserRepository
{
    protected $model;

    protected $fields = [
        'name',
        'login',
        'password'
    ];

    public function __construct(UserModel $userModel)
    {
        $this->model = $userModel;
    }

    public function find(int $id) : UserModel
    {
        $model = $this->model->where('id', '=', $id)->first();

        if (!$model)
        {
            throw new \App\Http\Exceptions\UserExistsException();
        }

        return $model;
    }

    public function all() : Collection
    {
        return $this->model->all();
    }

    public function save(Array $input)
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

    public function update(Int $id, Array $input) : UserModel
    {
        $model = $this->model->find($id);

        foreach ($this->fields as $field)
        {
            if (isset($input[$field]))
            {
                $model->{$field} = $input[$field];
            }
        }

        $model->save();

        return $model;
    }

    public function delete(Int $id)
    {
        $model = $this->model->find($id);

        return $model->delete();
    }

    public function getWhere(Array $input) : Collection
    {
        $model = $this->model->orderBy('name', 'ASC');

        if (isset($input['userName']))
        {
            $model = $model->where('name', 'ilike', '%'.$input['userName'].'%');
        }

        if (isset($input['userLogin']))
        {
            $model = $model->where('login', 'ilike', '%'.$input['userLogin'].'%');
        }

        return $model->get();
    }
}
