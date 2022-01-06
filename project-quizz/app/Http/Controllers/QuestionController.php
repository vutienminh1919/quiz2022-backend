<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Answer;
use App\Models\Question;


use App\Repositories\QuestionRepository;


use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        $questions = Question::all();
        return response()->json($questions);
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = $this->questionRepository->store($request);
        return response()->json($question);
    }

    public function show($id)
    {
        $question = $this->questionRepository->getById($id);
        return response()->json($question);
    }

    public function update($id,UpdateQuestionRequest $request)
    {

        $question = $this->questionRepository->update($id, $request);
        return response()->json($question);
    }

    public function destroy($id)
    {
        $this->questionRepository->destroy($id);
        return response()->json('delete successfully');
    }
}
