<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CRUDinterfaceRepo;

class EloquentRepo implements CRUDinterfaceRepo
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public function getModel()
    {
//        return $this->model;
    }

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    public function create($data)
    {
        try {
            $object = $this->model->create($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $object;
    }

    public function update($data, $object)
    {
        return $object->update($data);
    }

    public function destroy($id)
    {
        $result = $this->findById($id);
        if ($result) {
            $result->delete();
            return true;
        }

        return false;
    }


}
