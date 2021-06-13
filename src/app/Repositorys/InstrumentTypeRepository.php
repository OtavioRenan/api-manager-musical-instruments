<?php
declare(strict_types=1);

namespace App\Repositorys;

class InstrumentTypeRepository
{
    protected $model;

    protected $fields = [
        'inst_typ_name',
        'inst_typ_slug'
    ];

    public function __construct(\App\Models\InstrumentTypeModel $instrumentTypeModel)
    {
        $this->model = $instrumentTypeModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('inst_typ_id', '=', $id)->first();

        if (!$model)
        {
            throw new \App\Http\Exception\InstrumentTypeExistsException();
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
        $model = $this->model->orderBy('inst_typ_name', 'ASC');

        if (isset($input['name']))
        {
            $model = $model->where('inst_typ_name', 'ilike', '%'.$input['name'].'%');
        }

        return $model->get();
    }
}
