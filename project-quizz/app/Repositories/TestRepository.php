<?php
namespace App\Repositories;

use App\Models\Test;

class TestRepository implements Repository
{

    public function getAll()
    {
        $tests = Test::all();
        return $tests;
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
