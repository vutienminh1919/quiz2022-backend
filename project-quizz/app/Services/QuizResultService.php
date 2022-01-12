<?php

namespace App\Services;

use App\Repositories\QuizResultRepo;

class QuizResultService implements CRUDinterfaceService
{
    protected $quizResultRepo;

    public function __construct(QuizResultRepo $quizResultRepo)
    {
        $this->quizResultRepo = $quizResultRepo;
    }

    public function getAll()
    {
        return $this->quizResultRepo->getAll();
    }

    public function findById($id)
    {
        return $this->quizResultRepo->findById($id);
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
