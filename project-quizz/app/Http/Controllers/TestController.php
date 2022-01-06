<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Test;
use App\Repositories\QuestionRepository;
use App\Services\TestServiceImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    protected $testService;
    protected $questionRepository;

    public function __construct(TestServiceImpl $testService, QuestionRepository $questionRepository)
    {
     $this->testService = $testService;
     $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        $test = $this->testService->getAll();
        return response()->json($test ,  200);
    }

    public function getAllQuestionByTest($id)
    {
//        $question = Question::find($id);
//        $tests = $question->tests;
//        dd($tests);

        $result = [];
        $questions = DB::table('question_test')->where('test_id', $id)->get();
        foreach ($questions as $question) {
            $result[] = $question->question_id;
        }
        dd($result);
    }

    public function getAllTestByQuestion($id)
    {
        $test = Test::find($id);
        $questions = $test->questions;
        dd($questions);
    }
    public function show($id)
    {
        $dataTest = $this->testService->findById($id);

        return response()->json($dataTest['tests'], $dataTest['statusCode']);
    }

    public function store(Request $request)
    {
        $questions = $this->questionRepository->getAll();
        $dataTest = $this->testService->create($request->all());

        return response()->json($dataTest, $dataTest['statusCode']);
    }

    public function update(Request $request, $id)
    {
        $dataTest = $this->testService->update($request->all(), $id);

        return response()->json($dataTest['tests'], $dataTest['statusCode']);
    }

    public function destroy($id)
    {
        $dataTest = $this->testService->destroy($id);

        return response()->json($dataTest['message'], $dataTest['statusCode']);
    }

}
