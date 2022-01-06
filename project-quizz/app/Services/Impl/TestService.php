<?php

namespace App\Services\Impl;

use App\Models\Test;
use App\Repositories\TestRepositoryImpl;
use App\Services\TestServiceImpl;

class TestService implements TestServiceImpl
{
    protected $testRepository;

    public function __construct(TestRepositoryImpl $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function getAll()
    {

        return $this->testRepository->getAll();
    }

    public function findById($id)
    {
        $test = $this->testRepository->findById($id);

        $statusCode = 200;
        if (!$test) {
            $statusCode = 404;
        }

        return [
            'statusCode' => $statusCode,
            'tests' => $test
        ];
    }

    public function create($request)
    {
        $test = $this->testRepository->create($request);
        $test->questions()->sync($request["question_id"]);

        $statusCode = 201;
        if (!$test) {
            $statusCode = 500;
        }

        return [
            'statusCode' => $statusCode,
            'message' => 'tao moi thanh cong'
        ];
    }

    public function update($request, $id)
    {
        $oldTest = $this->testRepository->findById($id);

        if (!$oldTest) {
            $newTest = null;
            $statusCode = 404;
        } else {
            $newTest = $this->testRepository->update($request, $oldTest);
            $statusCode = 200;
        }

        return [
            'statusCode' => $statusCode,
            'tests' => $newTest
        ];
    }

    public function destroy($id)
    {
        $test = $this->testRepository->findById($id);

        $statusCode = 404;
        $message = "Test not found";
        if ($test) {
            $this->testRepository->destroy($test);
            $statusCode = 200;
            $message = "Delete success!";
        }

        return [
            'statusCode' => $statusCode,
            'message' => $message
        ];
    }
}
