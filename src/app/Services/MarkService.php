<?php
declare(strict_types=1);

namespace App\Services;

class MarkService
{
    protected $repository;

    public function __construct(\App\Repositorys\MarkRepository $markRepository)
    {
        $this->repository = $markRepository;
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
        $mark = $this->repository->save($this->filterInput($input));

        return $this->filterOutput($mark);
    }

    public function update(Int $id, Array $input)
    {
        $datas = $this->filterInput($input);

        $mark = $this->repository->update($id, $datas);

        return $this->filterOutput($mark);
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
            $filters['mark_name'] = $input['name'];
        }

        return $filters;
    }

    private function filterOutput(\App\Models\MarkModel $model) : Array
    {
        return [
            'id' => $model->mark_id,
            'name' => $model->mark_name,
            'slug' => $model->mark_slug
        ];
    }

    private function filterInput(Array $input) : Array
    {
        return [
            'mark_name' => $input['name'],
            'mark_slug' => $input['slug']
        ];
    }
}
