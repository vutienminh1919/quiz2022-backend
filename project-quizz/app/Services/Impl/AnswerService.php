<?php

namespace App\Services\Impl;

use App\Repositories\AnswerRepositoryImp;

use App\Repositories\Impl\AnswerRepository;

class AnswerService
{
    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function getAll()
    {
        return $this->answerRepository->getAll();
    }

    public function findById($id)
    {
        $answer = $this->answerRepository->findById($id);

        $statusCode = 200;
        if (!$answer) {
            $statusCode = 404;
        }

        return [
            'statusCode' => $statusCode,
            'answer' => $answer
        ];
    }

    public function create($request)
    {
        $answer = $this->answerRepository->create($request);

        $statusCode = 201;
        if (!$answer) {
            $statusCode = 500;
        }

        return [
            'statusCode' => $statusCode,
            'answer' => $answer
        ];
    }

    public function update($request, $id)
    {
        $oldAnswer = $this->answerRepository->findById($id);

        if (!$oldAnswer) {
            $newAnswer = null;
            $statusCode = 404;
        } else {
            $newAnswer = $this->answerRepository->update($request, $oldAnswer);
            $statusCode = 200;
        }

        return [
            'statusCode' => $statusCode,
            'answer' => $newAnswer
        ];
    }

    public function destroy($id)
    {
        $answer = $this->answerRepository->findById($id);

        $statusCode = 404;
        $message = "Answer not found";
        if ($answer) {
            $this->answerRepository->destroy($answer);
            $statusCode = 200;
            $message = "Delete success!";
        }

        return [
            'statusCode' => $statusCode,
            'message' => $message
        ];
    }
}
