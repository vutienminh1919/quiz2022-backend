<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Models\Question;
use App\Models\Test;

use App\Repositories\TestRepository;
use App\Services\TestServiceImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    protected $testRepository;
    public function __construct(TestRepository $testRepository)
    {
     $this->testRepository= $testRepository;
    }

    public function index()
    {
        $tests = $this->testRepository->getAll();
        return response()->json($tests, 200);
    }

    public function store(StoreTestRequest $request)
    {
        $test = $this->testRepository->store($request);
        return response()->json($test, 200);
    }

    public function update(UpdateTestRequest $request, $id)
    {
        $test= $this->testRepository->update($request, $id);
        return response()->json($test, 200);
    }

    public function destroy($id)
    {
        $this->testRepository->destroy($id);
        return response()->json(["message"=> "Xoa thanh cong"], 200);
    }




}
