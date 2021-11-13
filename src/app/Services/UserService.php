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

    public function all(Array $input) : Array
    {
        return array_map(array($this, 'filterOutput'), $this->repository->getWhere($this->filter($input))->all());
    }

    public function find(Int $id) : Array
    {
        return $this->filterOutput($this->repository->find($id));
    }

    public function save($input) : Array
    {
        $user = $this->repository->save($this->filterInput($input));

        return $this->filterOutput($user);
    }

    public function update(Int $id, Array $input) : Array
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

        if(isset($input['userName']))
        {
            $filters['name'] = $input['userName'];
        }

        if(isset($input['userLogin']))
        {
            $filters['login'] = $input['userLogin'];
        }

        return $filters;
    }

    private function filterOutput(\App\Models\UserModel $model) : Array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'login' => $model->login
        ];
    }

    private function filterInput(Array $input) : Array
    {
        return [
            'name' => $input['userName'],
            'login' => $input['userLogin'],
            'password' => $input['userPassword']
        ];
    }
}
