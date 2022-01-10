<?php

namespace App\Services;

use App\Repositories\QuizQuestionRepo;

class QuizQuestionService implements CRUDinterfaceService
{
    protected $quizQuesRepo;
    protected $questionService;

    public function __construct(QuizQuestionRepo $quizQuesRepo, QuestionService $questionService)
    {
        $this->quizQuesRepo = $quizQuesRepo;
        $this->questionService = $questionService;
    }

    public function getAll()
    {
        $quizzes = $this->quizQuesRepo->getAll();
        return $quizzes;
    }

    public function findById($id)
    {
        $question = $this->quizQuesRepo->findById($id);

        if (!$question) {
            return 404;
        }
        return ['question'=> $question];
    }

    public function create($request)
    {
        $question = $this->quizQuesRepo->create($request);

        if (!$question) {
            return 500;
        }
        return ['question' => $question];
    }

    public function update($request, $id)
    {
        $oldQuestion = $this->quizQuesRepo->findById($id);

        if (!$oldQuestion) {
            $newQuestion = null;
            return 404;
        } else {
            $newQuestion = $this->quizQuesRepo->update($request, $oldQuestion);
        }
        return [
            'question' => $newQuestion
        ];    }

    public function destroy($id)
    {
        $question = $this->quizQuesRepo->findById($id);

        if ($question) {
            return $this->quizQuesRepo->destroy($id);
        }

        return 404;
    }
    public function getQuestionsByQuizId($id)
    {
        return $this->quizQuesRepo->getQuestionsByQuizId($id);
    }

    public function generate($quiz, $count)
    {
        $questions = $this->questionService->getAll();
        $question_id = [];
        foreach ($questions as $value) {
            $question_id[] = $value->id;
        }
        shuffle($question_id);
        for (
            $i = 0;
            $i < (($count > count($question_id)) ? count($question_id) : $count);
            $i++
        ) {
            $data = [
                'quiz_id' => $quiz->id,
                'question_id' => $question_id[$i]
            ];
            $this->quizQuesRepo->create($data);
        }
        return ($count > count($question_id)) ? false : true;
    }
}
