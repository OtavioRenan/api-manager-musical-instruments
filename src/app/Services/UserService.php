<?php
declare(strict_types=1);

namespace App\Services;

class UserService
{
    protected $repository;

    public function __construct(\App\Repositorys\UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function all(Array $input)
    {
        return array_map(array($this, 'filterOutput'), $this->repository->getWhere($this->filter($input))->all());
    }

    public function find(Int $id)
    {
        return $this->filterOutput($this->repository->find($id));
    }

    public function save($input)
    {
        $user = $this->repository->save($this->filterInput($input));

        return $this->filterOutput($user);
    }

    public function update(Int $id, Array $input)
    {
        $datas = $this->filterInput($input);

        $type = $this->repository->update($id, $datas);

        return $this->filterOutput($type);
    }

    public function delete(Int $id)
    {
        return $this->repository->delete($id);
    }

    private function filter(Array $input) : Array
    {
        $filters = [];

        if(isset($input['name']))
        {
            $filters['user_name'] = $input['name'];
        }

        if(isset($input['login']))
        {
            $filters['user_login'] = $input['login'];
        }

        return $filters;
    }

    private function filterOutput(\App\Models\UserModel $model) : Array
    {
        return [
            'id' => $model->user_id,
            'name' => $model->user_name,
            'login' => $model->user_login
        ];
    }

    private function filterInput(Array $input) : Array
    {
        return [
            'user_name' => $input['name'],
            'user_login' => $input['login'],
            'user_password' => $input['password']
        ];
    }
}
