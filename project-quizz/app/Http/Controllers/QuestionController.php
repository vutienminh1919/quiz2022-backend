<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionFormRequest;
use App\Http\Requests\UpdateQuestionsRequest;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Services\AnswerService;
use App\Services\CategoryService;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class QuestionController extends Controller
{
    protected $questionService;
    protected $categoryService;
    protected $answerService;

    public function __construct(
        QuestionService $questionService,
        CategoryService $categoryService,
        AnswerService $answerService
    ) {
        $this->questionService = $questionService;
        $this->categoryService = $categoryService;
        $this->answerService = $answerService;
    }

    public function index()
    {
        $questions = $this->questionService->getAll();
//        $categories = $this->categoryService->getAll();
//        $answers = $this->answerService->getAll();
        return response()->json($questions);
    }
//    public function show($id)
//    {
//        $data = $this->questionService->findById($id);
//        return response()->json($data['question'], 200);
//
//    }
    public function show($id)
    {
        $data = $this->questionService->findById($id);
        return response()->json($data, 200);
    }

    public function create()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $question = new Question();
            $question->question_content = $request->question_content;
            $question->difficulty= $request->difficulty;
            $question->category_id= $request->category_id;
            $question->save();
            foreach ($request->answers as $an){
                $answer= new Answer();
                $answer->answer_content = $an[0];
                $answer->question_id = $question->id;
                $answer->correct = $an[1];
                $answer->save();
            }
            DB::commit();
            $data = [
                "status"=>"Success",
                "message"=> "Them moi thanh cong"
            ];
            return response()->json($data);

        } catch (Exception $exception){
            DB::rollBack();
            $data = [
                "status"=>"Error",
                "message"=> $exception->getMessage()
            ];
            return response()->json($data);
        }

    }
    public function update(Request $request, $id)
    {

        $question = Question::findOrFail($id);
        $question->update($request->all());
        foreach ($request->answers as $an){

            $answer= new Answer();
            $answer->answer_content = $an[0];
            $answer->question_id = $question->id;
            $answer->correct = $an[1];
            $answer->save();
        }

        DB::commit();
        $data = [
            "status"=>"Success",
            "message"=> "Sua thanh cong"
        ];

        return response()->json($data);
    }
    public function destroy($id)
    {
//        if ($this->questionService->isQuestionUsedInQuiz($id)) {
//            return response()->json(['message'=>'Delete unavailable!Question already has used in Quiz.']);
//        } else {
            $this->questionService->destroy($id);
            return response()->json(['message'=>'Delete completed']);
//        }
    }
}
