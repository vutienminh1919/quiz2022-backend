<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        $question = $this->questionRepository->getAll();
        return response()->json($question);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function store(Request $request)
    {
        $data = $request->all();
        $question = $this->questionRepository->create($data);
        return response()->json($question);
    }


    public function show(Question $question,$id)
    {
        $question = $this->questionRepository->findById($id);
        return $question;
    }

    public function edit(Question $question)
    {
        //
    }

    public function update($id,Request $request)
    {
        $question = $this->questionRepository->update($id, $request->all());
        return $question;
    }

    public function destroy($id)
    {
        $this->questionRepository->destroy($id);
    }
}
