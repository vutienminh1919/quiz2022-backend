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
        $test = Test::findOrFail($id);
        return $test;
    }

    public function store($request)
    {
        $data = $request->only('title');
        $test = Test::query()->create($data);
        return $test;
    }

    public function update($request, $id)
    {
        Test::query()->findOrFail($id);
        $data = $request->only('title');
        return Test::query()->where('id','=', $id)->update($data);
    }

    public function destroy($id)
    {
        $test = Test::query()->findOrFail($id);
        $test->delete();
    }
}
