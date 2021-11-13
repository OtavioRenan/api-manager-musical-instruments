<?php
declare(strict_types=1);

namespace App\Services;

class ModelYearService
{
    protected $repository;

    public function __construct(\App\Repositorys\ModelYearRepository $modelYearRepository)
    {
        $this->repository = $modelYearRepository;
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
            $filters['mode_yea_launch'] = $input['launch'];
        }

        if(isset($input['end']))
        {
            $filters['mode_yea_end_of_production'] = $input['end'];
        }

        return $filters;
    }

    private function filterOutput(\App\Models\ModelYearModel $model) : Array
    {
        return [
            'id' => $model->mode_yea_id,
            'launch' => $model->mode_yea_launch,
            'end' => $model->mode_yea_end_of_production
        ];
    }

    private function filterInput(Array $input) : Array
    {
        return [
            'mode_yea_launch' => $input['launch'],
            'mode_yea_end_of_production' => isset($input['end']) ? $input['end'] : null
        ];
    }
}
