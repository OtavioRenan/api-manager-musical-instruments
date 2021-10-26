<?php
declare(strict_types=1);

namespace App\Repositorys;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ModelsRepository {

    protected $model;
    protected $fields;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->fields = $model->getFillable();
    }

    public function find(int $id) : Model
    {
        $model = $this->model->where($this->model->getKey(), '=', $id)->first();

        if (!$model)
        {
            throw new \Exception('Registro não encontrado.');
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

    public function update(Int $id, Array $input) : Model
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
