<?php
declare(strict_types=1);

namespace App\Repositorys;

class InstrumentRepository
{
    protected $model;

    protected $fields = [
        'inst_name',
        'inst_slug',
        'inst_description',
        'id_inst_typ',
        'id_mode',
        'id_mark'
    ];

    public function __construct(\App\Models\InstrumentModel $instrumentModel)
    {
        $this->model = $instrumentModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('inst_id', '=', $id)->first();

        if (!$model)
        {
            throw new \App\Http\Exceptions\InstrumentExistsException();
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
        $model = $this->model->orderBy('inst_name', 'ASC');

        if (isset($input['name']))
        {
            $model = $model->where('inst_name', 'ilike', '%'.$input['name'].'%');
        }

        if (isset($input['description']))
        {
            $model = $model->where('inst_description', 'ilike', '%'.$input['description'].'%');
        }

        return $model->get();
    }
}
