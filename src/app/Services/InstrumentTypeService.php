<?php
declare(strict_types=1);

namespace App\Services;

class InstrumentTypeService
{
    protected $repository;

    public function __construct(\App\Repositorys\InstrumentTypeRepository $instrumentTypeRepository)
    {
        $this->repository = $instrumentTypeRepository;
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
        $type = $this->repository->save($this->filterInput($input));

        return $this->filterOutput($type);
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
            $filters['inst_typ_name'] = $input['name'];
        }

        return $filters;
    }

    private function filterOutput(\App\Models\InstrumentTypeModel $model) : Array
    {
        return [
            'id' => $model->inst_typ_id,
            'name' => $model->inst_typ_name,
            'slug' => $model->inst_typ_slug
        ];
    }

    private function filterInput(Array $input) : Array
    {
        return [
            'inst_typ_name' => $input['name'],
            'inst_typ_slug' => $input['slug']
        ];
    }
}
