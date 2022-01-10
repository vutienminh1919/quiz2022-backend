<?php

namespace App\Services;

use App\Repositories\CRUDinterfaceRepo;
use App\Repositories\QuizQuestionRepo;

class QuizQuestionService implements CRUDinterfaceRepo
{
    protected $quizQuesRepo;
    protected $questionService;

    public function __construct(
        QuizQuestionRepo $quizQuesRepo,
        QuestionService $questionService
    )
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

        return $question;
    }

    public function create($request)
    {
        $question = $this->quizQuesRepo->create($request);
        return $question;
    }

    public function update($id, $request)
    {
        $oldQuestion = $this->quizQuesRepo->findById($id);

        if (!$oldQuestion) {
            if (!$oldQuestion) {
                return 404;
            } else {
                return  $this->quizQuesRepo->update($request, $oldQuestion);
            }
        }
    }

    public function destroy($id)
    {
        $question = $this->quizQuesRepo->findById($id);

        if ($question) {
            return $this->quizQuesRepo->destroy($id);
        }

        abort(404);
    }

    public function getQuestionsByQuizId($id)
    {
        return $this->quizQuesRepo->getQuestionsByQuizId($id);
    }

    public function generate($quiz, $count)
    {
        $questions = $this->questionService->getQuestionsByCategoryId($quiz->category_id);
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
