<?php
declare(strict_types=1);

namespace App\Services;

class LogService
{
    protected $repository;

    public function __construct(\App\Repositorys\LogRepository $logRepository)
    {
        $this->repository = $logRepository;
    }

    public function all(Array $input)
    {
        return array_map(array($this, 'filterOutput'), $this->repository->getWhere($this->filter($input))->all());
    }

    public function find(Int $id)
    {
        return $this->filterOutput($this->repository->find($id));
    }

    private function filter(Array $input) : Array
    {
        $filters = [];

        if (isset($input['userId']))
        {
            $filters['user_id'] = $input['userId'];
        }

        if (isset($input['action']))
        {
            $filters['action'] = $input['action'];
        }

        return $filters;
    }

    private function filterOutput(\App\Models\LogModel $model) : Array
    {
        return [
            'systemLogableId' => $model->system_logable_id,
            'systemLogableYype' => $model->system_logable_type,
            'userId' => $model->user_id,
            'guardName' => $model->guard_name,
            'action' => $model->action,
            'oldValue' => (!is_null($model->old_value)) ? json_decode((string)$model->old_value) : null,
            'newValue' => (!is_null($model->new_value)) ? json_decode((string)$model->new_value) : null,
            'ipAddress' => $model->ip_address,
        ];
    }
}
