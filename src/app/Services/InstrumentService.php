<?php
declare(strict_types=1);

namespace App\Services;

class InstrumentService
{
    protected $repository;

    public function __construct(\App\Repositorys\InstrumentRepository $instrumentRepository)
    {
        $this->repository = $instrumentRepository;
    }

    public function all(Array $input)
    {
        return array_map(array($this, 'filterOutput'), $this->repository->getWhere($this->filter($input))->all());
    }

    public function find(Int $id)
    {
        return $this->filterOutput($this->repository->find($id));
    }

    public function save(Array $input)
    {
        $instrument = $this->repository->save($this->filterInput($input));

        return $this->filterOutput($instrument);
    }

    public function update(Int $id, Array $input)
    {
        $datas = $this->filterInput($input);

        $instrument = $this->repository->update($id, $datas);

        return $this->filterOutput($instrument);
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
            $filters['inst_name'] = $input['name'];
        }

        if(isset($input['description']))
        {
            $filters['inst_description'] = $input['description'];
        }

        return $filters;
    }

    private function filterOutput(\App\Models\InstrumentModel $model) : Array
    {
        return [
            'id' => $model->inst_id,
            'name' => $model->inst_name,
            'slug' => $model->inst_slug,
            'description' => $model->inst_description,
            'instrumentType' => [
                'id' => (!is_null($model->type)) ? $model->type->inst_typ_id : null,
                'name' => (!is_null($model->type)) ? $model->type->inst_typ_name : null,
            ],
            // 'mode' => [
            //     'id' => (!is_null($model->mode)) ? $model->mode->mode_id : null,
            //     'name' => (!is_null($model->mode)) ? $model->mode->mode_name : null,
            //     'year' => [
            //         'id' => (!is_null($model->mode->year->mode_yea_id)) ? $model->mode->year->mode_yea_id : null,
            //         'launch' => (!is_null($model->mode->year->mode_yea_launch)) ? $model->mode->year->mode_yea_launch : null,
            //         'endProduction' => (!is_null($model->mode->year->mode_yea_end_of_production)) ? $model->mode->year->mode_yea_end_of_production : null,
            //     ]
            // ],
            // 'mark' => [
            //     'id' => (!is_null($model->mark->mark_id)) ? $model->mark->mark_id : null,
            //     'name' => (!is_null($model->mark->mark_name)) ? $model->mark->mark_name : null,
            // ],
        ];
    }

    private function filterInput(Array $input) : Array
    {
        return [
            'inst_name' => $input['name'],
            'inst_slug' => $input['slug'],
            'inst_description' => $input['description'],
            'id_inst_typ' => (array_key_exists('idInstrumentType', $input)) ? $input['idInstrumentType'] : null,
            'id_mode' => (array_key_exists('idMode', $input)) ? $input['idMode'] : null,
            'id_mark' => (array_key_exists('idMark', $input)) ? $input['idMark'] : null,
        ];
    }
}
