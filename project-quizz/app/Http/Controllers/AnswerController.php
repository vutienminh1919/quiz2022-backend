<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;

use App\Services\CategoryServiceImpl;
use App\Services\Impl\AnswerService;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    protected $answerService;

    public function __construct(AnswerService $answerService)
    {
        $this->answerService = $answerService;
    }

    public function index()
    {
        $answers = $this->answerService->getAll();
        return response()->json($answers, 200);
    }

    public function show($id)
    {
        $answer = $this->answerService->findById($id);
        return response()->json($answer['answer'], $answer['statusCode']);

    }

    public function store(AnswerRequest $request)
    {
        $answer = $this->answerService->create($request->all());
        return response()->json($answer['answer'], $answer['statusCode']);
    }

    public function update(AnswerRequest $request, $id)
    {
        $answer = $this->answerService->update($request->all(), $id);
        return response()->json($answer['answer'], $answer['statusCode']);
    }

    public function destroy($id)
    {
        $answer = $this->answerService->destroy($id);
        return response()->json($answer['message'], $answer['statusCode']);
    }
}
