<?php

namespace App\Http\Controllers;

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
    }




}
