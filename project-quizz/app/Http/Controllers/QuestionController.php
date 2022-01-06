<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Repositories\QuestionRepository;
use App\Services\Impl\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    protected $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function index()
    {
        $answers = $this->questionService->getAll();
        return response()->json($answers, 200);
    }

    public function show($id)
    {
        $answer = $this->questionService->findById($id);
        return response()->json($answer['answer'], $answer['statusCode']);

    }

    public function store(QuestionRequest $request)
    {
        $answer = $this->questionService->create($request->all());
        return response()->json($answer['answer'], $answer['statusCode']);
    }

    public function update(QuestionRequest $request, $id)
    {
        $answer = $this->questionService->update($request->all(), $id);
        return response()->json($answer['answer'], $answer['statusCode']);
    }

    public function destroy($id)
    {
        $answer = $this->questionService->destroy($id);
        return response()->json($answer['message'], $answer['statusCode']);
    }
}
