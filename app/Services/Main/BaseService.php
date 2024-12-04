<?php

namespace App\Services\Main;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getData()
    {
        return $this->model->all();
    }

    public function storeData(array $array)
    {
        return $this->model->create($array);
    }

    public function getIndividualData($id)
    {
        return $this->model->find($id);
    }

    public function updateData(array $array, $id)
    {
        $id = $this->model->find($id);

        return $id->update($array);
    }

    public function deleteData($id)
    {
        return $this->model->find($id)->delete();
    }
}
