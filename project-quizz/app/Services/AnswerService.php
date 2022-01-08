<?php

namespace App\Services;

use App\Repositories\AnswerRepo;

class AnswerService implements CRUDinterfaceService
{
    protected $answerRepo;

    public function __construct(AnswerRepo $answerRepo)
    {
        $this->answerRepo = $answerRepo;
    }

    public function getAll()
    {
        $answers = $this->answerRepo->getAll();
        return $answers;
    }

    public function findById($id)
    {
        $answer = $this->answerRepo->findById($id);

        if (!$answer) {
            return 404;
        }
        return ['answer' => $answer];
    }

    public function create($request)
    {
        if ($request['correct'] == null) {
            $request['correct'] = 0;
        };
        $answer = $this->answerRepo->create($request);
        return ['answer' => $answer];
    }

    public function update($request, $id)
    {
        $oldAnswer = $this->answerRepo->findById($id);

        if (!$oldAnswer) {
            $newAnswer = null;
            return 404;
        } else {
            $newAnswer = $this->answerRepo->update($request, $oldAnswer);
        }
        return [
            'answer' => $newAnswer
        ];
    }

    public function destroy($id)
    {
        $answer = $this->answerRepo->findById($id);

        if ($answer) {
            return $this->answerRepo->destroy($id);
        }

        return 404;
    }
    public function getAnswerByQuestionId($question_id)
    {
        return $this->answerRepo->getAnswerByQuestionId($question_id);
    }
}
