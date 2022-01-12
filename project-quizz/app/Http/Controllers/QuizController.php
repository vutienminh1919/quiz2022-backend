<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizFormRequest;
use App\Http\Services\QuizQuestionService;
use App\Models\Question;
use App\Models\Quiz;
use App\Repositories\QuizRepo;
use App\Services\CategoryService;
use App\Services\QuestionService;

use App\Services\QuizService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    protected $quizService;
    protected $categoryService;
    protected $quizQuestionService;
    protected $questionService;
    protected $quizRepo;

    public function __construct(
        QuizService         $quizService,
        CategoryService     $categoryService,
        QuizQuestionService $quizQuestionService,
        QuestionService     $questionService,
        QuizRepo $quizRepo
    )
    {
        $this->quizService = $quizService;
        $this->categoryService = $categoryService;
        $this->quizQuestionService = $quizQuestionService;
        $this->questionService = $questionService;
        $this->quizRepo = $quizRepo;

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
//            $quiz->published = $request->published;
            $quiz->save();
            $quiz->questions()->sync($request->questions);
            DB::commit();
            $data = [
                "status" => "Success",
                "message" => "Them moi thanh cong"
            ];
            return response()->json($data);
        } catch (Exception $exception) {
            DB::rollBack();
            $data = [
                "status" => "Error",
                "message" => $exception->getMessage()
            ];
            return response()->json($data);
        }
    }

    public function getAllQuestion()
    {
        $questions = $this->questionService->getAll();
        return response()->json($questions);
    }

    public function show($id)
    {

        $quiz = $this->quizRepo->findById($id);
        return response()->json($quiz);

    }

    public function edit($id)
    {
        $quiz_questions = $this->quizQuestionService->getQuestionsByQuizId($id);
        $quiz = $this->quizService->findById($id);
    }

}
