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
        $questions = $this->questionService->getAll();
        return response()->json($questions, 200);
    }

    public function show($id)
    {
        $question = $this->questionService->findById($id);
        return response()->json($question['question'], $question['statusCode']);

    }

    public function store(QuestionRequest $request)
    {
        $question = $this->questionService->create($request->all());
        return response()->json($question['question'], $question['statusCode']);
    }

    public function update(QuestionRequest $request, $id)
    {
        $question = $this->questionService->update($request->all(), $id);
        return response()->json($question['question'], $question['statusCode']);
    }

    public function destroy($id)
    {
        $question = $this->questionService->destroy($id);
        return response()->json($question['message'], $question['statusCode']);
    }
}
