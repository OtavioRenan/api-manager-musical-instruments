<?php
declare(strict_types=1);

namespace App\Repositorys;

class UserRepository
{
    protected $model;

    protected $fields = [
        'user_name',
        'user_login',
        'user_password'
    ];

    public function __construct(\App\Models\UserModel $userModel)
    {
        $this->model = $userModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('user_id', '=', $id)->first();

        if (!$model)
        {
            throw new \App\Http\Exceptions\UserExistsException();
        }

        return $model;
    }

    public function all()
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

    public function update(Int $id, Array $input)
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

    public function getWhere(Array $input)
    {
        $model = $this->model->orderBy('user_name', 'ASC');

        if (isset($input['name']))
        {
            $model = $model->where('user_name', 'ilike', '%'.$input['name'].'%');
        }

        if (isset($input['login']))
        {
            $model = $model->where('user_login', 'ilike', '%'.$input['login'].'%');
        }

        return $model->get();
    }
}
