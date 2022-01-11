<?php

namespace App\Services;



use App\Repositories\QuizRepo;

class QuizService implements CRUDinterfaceService
{
    protected $quizRepo;

    public function __construct(QuizRepo $quizRepo)
    {
        $this->quizRepo = $quizRepo;
    }

    public function getAll()
    {
        return $this->quizRepo->getAll();
    }

    public function findById($id)
    {
        $quiz = $this->quizRepo->findById($id);

        if (!$quiz) {
            return 404;
        }
        return ['quiz' => $quiz];
    }

    public function create($request)
    {
        $quiz = $this->quizRepo->create($request);

        if (!$quiz) {
            return 500;
        }
        return ['quiz' => $quiz];
    }

    public function update($request, $id)
    {
        $oldQuiz = $this->quizRepo->findById($id);

        if (!$oldQuiz) {
            $newQuiz = null;
            return 404;
        } else {
            $newQuiz = $this->quizRepo->update($request, $oldQuiz);
        }
        return [
            'quiz' => $newQuiz
        ];
    }

    public function destroy($id)
    {
        $quiz = $this->quizRepo->findById($id);

        if ($quiz) {
            return $this->quizRepo->destroy($id);
        }

        return 404;
    }
    public function latest()
    {
        return $this->quizRepo->latest();
    }
}
