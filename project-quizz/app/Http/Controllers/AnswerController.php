<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Repositories\AnswerRepository;
use App\Services\AnswerService;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    protected $answerService;


    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function index()
    {

        $answers = $this->answerRepository->getAll();

//        $question = Answer::find($answers['question_id'])->question['question_name'];
        return response()->json( $answers, 200);
    }

    public function show($id)
    {
        $answer = $this->answerRepository->getById($id);
        return response()->json($answer, 200);

    }

    public function store(AnswerRequest $request)
    {

    }

    public function update(AnswerRequest $request, $id)
    {
        $answer = $this->answerRepository->update($request, $id);
        return response()->json(['message' => ' update success', 'data' => $answer]);
    }


    public function destroy($id)
    {
        $this->answerService->destroy($id);
        return response()->json(['message'=>'Xóa thành công'], 200);
    }
}
