<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizFormRequest;
use App\Http\Services\QuizQuestionService;
use App\Models\Question;
use App\Models\Quiz;
use App\Services\CategoryService;
use App\Services\QuestionService;

use App\Services\QuizService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class QuizController extends Controller
{
    protected $quizService;
    protected $categoryService;
    protected $quizQuestionService;
    protected $questionService;

    public function __construct(
        QuizService         $quizService,
        CategoryService     $categoryService,
        QuizQuestionService $quizQuestionService,
        QuestionService     $questionService
    )
    {
        $this->quizService = $quizService;
        $this->categoryService = $categoryService;
        $this->quizQuestionService = $quizQuestionService;
        $this->questionService = $questionService;
    }

    public function index()
    {
        $quizzes = $this->quizService->getAll();
        return response()->json($quizzes);
    }

    public function store(QuizFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $quiz = new Quiz();
            $quiz->name = $request->name;
            $quiz->duration = $request->duration;
            $quiz->published = $request->published;
            $quiz->save();
            $quiz->questions()->sync($request->questions);
            DB::commit();
            $data = [
                "status"=>"Success",
                "message"=> "Them moi thanh cong"
            ];
            return response()->json($data);
        } catch (Exception $exception) {
            DB::rollBack();
            $data = [
                "status"=>"Error",
                "message"=> $exception->getMessage()
            ];
            return response()->json($data);
        }
    }

}
