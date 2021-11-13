<?php
declare(strict_types=1);

namespace App\Repositorys;

use App\Models\LogModel;
use Illuminate\Support\Collection;

class LogRepository
{
    protected $model;

    protected $fields = [
        'system_logable_id',
        'system_logable_type',
        'user_id',
        'guard_name',
        'action',
        'old_value',
        'new_value',
        'ip_address'
    ];

    public function __construct(LogModel $markModel)
    {
        $this->model = $markModel;
    }

    public function find(int $id) : LogModel
    {
        $model = $this->model->where('logs_id', '=', $id)->first();

        if (!$model)
        {
            throw new \Exception('Log não encontrado.');
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

    public function update(Int $id, Array $input) : LogModel
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
        $fields = $this->fields;

        $model = $this->model->orderBy($fields[0], 'ASC');

        foreach($fields as $field)
        {
            if (isset($input[$field]))
            {
                $model = $model->where($field, 'ilike', '%' . $input[$field] . '%');
            }
        }

        return $model->get();
    }
}
