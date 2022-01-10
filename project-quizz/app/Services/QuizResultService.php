<?php

namespace App\Services;

use App\Repositories\QuizResultRepo;

class QuizResultService
{
    protected $quizResultRepo;

    public function __construct(QuizResultRepo $quizResultRepo)
    {
        $this->quizResultRepo = $quizResultRepo;
    }

    public function getAll()
    {
        $quizResult = $this->quizResultRepo->getAll();
        return $quizResult;
    }

    public function findById($id)
    {
        $quizResult = $this->quizResultRepo->findById($id);

        return  $quizResult;
    }

    public function create($request)
    {
        return $this->quizResultRepo->create($request);
    }

    public function update($id, $request)
    {
        $oldQuizResult = $this->quizResultRepo->findById($id);

        $this->quizResultRepo->update($request, $oldQuizResult);
    }

    public function destroy($id)
    {
        $quizResult = $this->quizResultRepo->findById($id);

        $this->quizResultRepo->destroy($quizResult);
    }
}
