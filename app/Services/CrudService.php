<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class CrudService
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    // Create a record
    public function create(array $data, array $rules = [])
    {
        $rules = $rules ?: $this->model::validationRules(); // Get validation rules dynamically
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        $record = $this->model::create($data);

        return ['success' => true, 'data' => $record];
    }

    // Read records with optional filters
    public function read(array $filters = [], $perPage = 10)
    {
        $query = $this->model::query();

        foreach ($filters as $key => $value) {
            $query->where($key, $value);
        }

        return $query->paginate($perPage);
    }

    // Update a record
    public function update($id, array $data, array $rules = [])
    {
        $rules = $rules ?: $this->model::validationRules();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        $record = $this->model::findOrFail($id);
        $record->update($data);

        return ['success' => true, 'data' => $record];
    }

    // Delete a record
    public function delete($id)
    {
        $record = $this->model::findOrFail($id);
        $record->delete();

        return ['success' => true, 'message' => 'Record deleted successfully'];
    }
}
