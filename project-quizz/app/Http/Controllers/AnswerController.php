<?php

namespace App\Http\Controllers;

use AnswerRepository;
use App\Http\Requests\AnswerRequest;
use App\Models\Answer;



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
        $answer = $this->answerRepository->getAll();
        return response()->json($answer, 200);
    }

    public function show($id)
    {


    }

    public function store(AnswerRequest $request)
    {

    }

    public function update(AnswerRequest $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
