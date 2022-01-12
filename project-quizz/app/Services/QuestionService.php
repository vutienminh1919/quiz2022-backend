<?php

namespace App\Services;


use App\Repositories\AnswerRepo;
use App\Repositories\QuestionRepo;

class QuestionService implements CRUDinterfaceService
{
    protected $questionRepo;
    protected $answerRepo;

    public function __construct(QuestionRepo $questionRepo, AnswerRepo $answerRepo)
    {
        $this->questionRepo = $questionRepo;
        $this->answerRepo = $answerRepo;
    }

    public function getAll()
    {
        $questions = $this->questionRepo->getAll();

        return $questions;
    }

    public function findById($id)
    {
        $question = $this->questionRepo->findById($id);

        if (!$question) {
            return 404;
        }
        return $question;
    }

    public function create($request)
    {
        $question = $this->questionRepo->create($request);

        if (!$question) {
            return 500;
        }
        return ['question' => $question];
    }

    public function update($request, $id)
    {
        $oldQuestion = $this->questionRepo->findById($id);

        if (!$oldQuestion) {
            $newQuestion = null;
            return 404;
        } else {
            $newQuestion = $this->questionRepo->update($request, $oldQuestion);
        }
        return [
            'question' => $newQuestion
        ];
    }

    public function destroy($id)
    {
        $question = $this->questionRepo->findById($id);
        $answers = $question->answers->all();
        if ($answers) {
            foreach ($answers as $answer) {
                $this->answerRepo->destroy($answer->id);
            }
        }

        if ($question) {
            return $this->questionRepo->destroy($id);
        }

        return 404;
    }
    public function getQuestionsByCategoryId($category_id)
    {
        return $this->questionRepo->getQuestionsByCategoryId($category_id);
    }

    public function isQuestionUsedInQuiz($id)
    {
        $question = $this->findById($id);
        return $question->quizQuestion->first();
    }
    public function latest (){
        return $this->questionRepo->latest();
    }
}
