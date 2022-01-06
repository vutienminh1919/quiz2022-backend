<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Difficulty;
use App\Services\Impl\DifficultyService;
use Illuminate\Http\Request;

class DifficultyController extends Controller
{
   protected $difficultyService;

   public function __construct(DifficultyService $difficultyService)
   {
       $this->difficultyService = $difficultyService;
   }

    public function index()
    {
        $difficulties = $this->difficultyService->getAll();
        return response()->json($difficulties, 200);
    }

    public function show($id)
    {
        $difficulty = $this->difficultyService->findById($id);
        return response()->json($difficulty['difficulty'], $difficulty['statusCode']);

    }

    public function store(Request $request)
    {
        $difficulty = $this->difficultyService->create($request->all());
        return response()->json($difficulty['difficulty'], $difficulty['statusCode']);
    }

    public function update(Request $request, $id)
    {
        $difficulty = $this->difficultyService->update($request->all(), $id);
        return response()->json($difficulty['difficulty'], $difficulty['statusCode']);
    }

    public function destroy($id)
    {
        $difficulty = $this->difficultyService->destroy($id);
        return response()->json($difficulty['message'], $difficulty['statusCode']);
    }
}
