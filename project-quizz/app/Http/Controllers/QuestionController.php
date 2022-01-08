<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionFormRequest;
use App\Http\Requests\UpdateQuestionsRequest;
use App\Models\Answer;
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
        $categories = $this->categoryService->getAll();
        return response()->json([$questions, $categories]);
    }
    public function show($id)
    {
        $data = $this->questionService->findById($id);
        return response()->json($data['question'], 200);
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

//        $answer_content[] = $request->answer_content;
//        $correct_option[] = $request->corrects;
//        if (!is_array(1, $correct_option)) {
//            return response()->json(['message'=>'Oops! Some thing wrong", "The question needs at least one correct answer'], 404);
//        }
//        $question = $this->questionService->create($request->all());
//        $answers = [];
//        for ($i = 0; $i < count($answer_content); $i++) {
//            $answerData = [
//                'question_id' => $question->id,
//                'answer_content' => $answer_content[$i],
//                'correct' => $correct_option[$i],
//            ];
//            $answer = $this->answerService->create($answerData);
//            array_push($answers, $answer);
//        };
//        if (!$question && !$answers) {
//            return response()->json(['message'=>'Create question error'], 500);
//        }
//        return response()->json(['message'=>'Created new question']);
    }
    public function update(UpdateQuestionsRequest $questionsRequest, $id)
    {
        $question_data = [
            "question_content" => $questionsRequest->question_content,
            "category_id" => $questionsRequest->category_id,
            "difficulty" => $questionsRequest->difficulty
        ];
        $this->questionService->update($question_data, $id);
        $question = $this->questionService->findById($id);
        $corrects = $questionsRequest->corrects;
        $answers = $questionsRequest->answer_content;
        $answerId = $question->answers;

        if (!$answers) {
            return response()->json(['message'=>'The question needs at least two answers.']);

        }

        if (count($answers) > count($answerId)) {
            for ($i = 0; $i < count($answers); $i++) {
                $data = [
                    "answer_content" => $answers[$i],
                    "correct" => $corrects[$i]
                ];
                $this->answerService->update($data, $answerId[$i]->id);
                if ($i = count($answers) - 1) {
                    $answerData = [
                        'question_id' => $question->id,
                        'answer_content' => $answers[$i],
                        'correct' => $corrects[$i],
                    ];
                    $this->answerService->create($answerData);
                }
            }
        } else {
            for ($i = 0; $i < count($answerId); $i++) {
                if ($i < count($answers)) {
                    $data = [
                        "answer_content" => $answers[$i],
                        "correct" => $corrects[$i]
                    ];
                    $this->answerService->update($data, $answerId[$i]->id);
                } else {
                    $this->answerService->destroy($answerId[$i]->id);
                }
            }
        }

        return response()->json(['message'=>'Updated successfully']);
    }
    public function destroy($id)
    {
        if ($this->questionService->isQuestionUsedInQuiz($id)) {
            return response()->json(['message'=>'Delete unavailable!Question already has used in Quiz.']);
        } else {
            $this->questionService->destroy($id);
            return response()->json(['message'=>'Delete completed']);
        }
    }
}
