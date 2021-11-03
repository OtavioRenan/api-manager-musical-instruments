<?php
declare(strict_types=1);

namespace App\Services;

class ModelService
{
    protected $repository;

    public function __construct(\App\Repositorys\ModelRepository $modelRepository)
    {
        $this->repository = $modelRepository;
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
        $model = $this->repository->save($this->filterInput($input));

        return $this->filterOutput($model);
    }

    public function update(Int $id, Array $input)
    {
        $datas = $this->filterInput($input);

        $model = $this->repository->update($id, $datas);

        return $this->filterOutput($model);
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
            $filters['mode_name'] = $input['name'];
        }

        if(isset($input['idYear']))
        {
            $filters['id_mode_yea'] = $input['idYear'];
        }

        return $filters;
    }

    private function filterOutput(\App\Models\ModelModel $model) : Array
    {
        $datas = [
            'id' => $model->mode_id,
            'name' => $model->mode_name,
            'slug' => $model->mode_slug,
            'year' => []
        ];

        if(!is_null($model->year))
        {
            $datas['year'] = [
                'id' => (!is_null($model->year->model_yea_id)) ? $model->year->model_yea_id : null,
                'launch' => (!is_null($model->year->mode_yea_launch)) ? $model->year->mode_yea_launch : null,
                'end' => (!is_null($model->year->mode_yea_end_of_production)) ? $model->year->mode_yea_end_of_production : null
            ];
        }

        return $datas;
    }

    private function filterInput(Array $input) : Array
    {
        return [
            'mode_name' => $input['name'],
            'mode_slug' => $input['slug'],
            'id_mode_yea' => isset($input['idYear']) ? $input['idYear'] : null
        ];
    }
}
