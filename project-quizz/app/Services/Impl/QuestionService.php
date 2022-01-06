<?php

namespace App\Services\Impl;

use App\Repositories\Impl\QuestionRepository;
use App\Repositories\QuestionRepositoryImp;

class QuestionService
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function getAll() {
        return $this->questionRepository->getAll();
    }
    public function findById($id)
    {
        $answer = $this->questionRepository->findById($id);

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
        $answer = $this->questionRepository->create($request);

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
        $oldAnswer = $this->questionRepository->findById($id);

        if (!$oldAnswer) {
            $newAnswer = null;
            $statusCode = 404;
        } else {
            $newAnswer = $this->questionRepository->update($request, $oldAnswer);
            $statusCode = 200;
        }

        return [
            'statusCode' => $statusCode,
            'answer' => $newAnswer
        ];
    }

    public function destroy($id)
    {
        $answer = $this->questionRepository->findById($id);

        $statusCode = 404;
        $message = "Answer not found";
        if ($answer) {
            $this->questionRepository->destroy($answer);
            $statusCode = 200;
            $message = "Delete success!";
        }

        return [
            'statusCode' => $statusCode,
            'message' => $message
        ];
    }
}
