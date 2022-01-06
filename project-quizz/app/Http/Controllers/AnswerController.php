<?php

namespace App\Http\Controllers;


use App\Http\Requests\AnswerRequest;
use App\Models\Answer;


use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function index()
    {
        $answers = $this->answerRepository->getAll();
        return response()->json($answers, 200);
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
        return response()->json(['message' => ' update success', 'data'=>$answer]);
    }

    public function destroy($id)
    {
        $this->answerRepository->destroy($id);
        return response()->json(['message' => ' Delete Success']);
    }

}
