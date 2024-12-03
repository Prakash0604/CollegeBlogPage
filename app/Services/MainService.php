<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class MainService
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all records
    public function getAllData()
    {
        return $this->model->all();
    }

    // Store a new record with validation
    public function storeData(array $array, array $rules = [])
    {
        // If no validation rules are provided, try to use model's validation rules
        $rules = $rules ?: $this->model::validationRules();

        $validator = Validator::make($array, $rules);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        // Create the new record
        return $this->model->create($array);
    }

    // Get individual record by ID
    public function getIndividualData($id)
    {
        $data = $this->model->find($id);

        if (! $data) {
            return ['success' => false, 'message' => 'Record not found'];
        }

        return ['success' => true, 'data' => $data];
    }

    // Update a record by ID with validation
    public function updateData(array $array, $id, array $rules = [])
    {
        // If no validation rules are provided, try to use model's validation rules
        $rules = $rules ?: $this->model::validationRules();

        $validator = Validator::make($array, $rules);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        $data = $this->model->find($id);

        if (! $data) {
            return ['success' => false, 'message' => 'Record not found'];
        }

        // Update the record
        $data->update($array);

        return ['success' => true, 'data' => $data];
    }

    // Delete a record by ID
    public function deleteData($id)
    {
        $data = $this->model->find($id);

        if (! $data) {
            return ['success' => false, 'message' => 'Record not found'];
        }

        // Delete the record
        $data->delete();

        return ['success' => true, 'message' => 'Record deleted successfully'];
    }
}
