<?php
declare(strict_types=1);

namespace App\Repositorys;

use App\Models\ModelModel;
use Illuminate\Support\Collection;

class ModelRepository
{
    protected $model;

    protected $fields = [
        'mode_name',
        'mode_slug'
    ];

    public function __construct(ModelModel $modelModel)
    {
        $this->model = $modelModel;
    }

    public function find(int $id) : ModelModel
    {
        $model = $this->model->where('mode_id', '=', $id)->first();

        if (!$model)
        {
            throw new \Exception('Modelo não encontrado.');
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

    public function update(Int $id, Array $input) : ModelModel
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
