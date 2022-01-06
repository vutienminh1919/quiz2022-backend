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
        $question = $this->questionRepository->findById($id);

        $statusCode = 200;
        if (!$question) {
            $statusCode = 404;
        }

        return [
            'statusCode' => $statusCode,
            'question' => $question
        ];
    }

    public function create($request)
    {
        $question = $this->questionRepository->create($request);

        $statusCode = 201;
        if (!$question) {
            $statusCode = 500;
        }

        return [
            'statusCode' => $statusCode,
            'question' => $question
        ];
    }

    public function update($request, $id)
    {
        $oldQuestion = $this->questionRepository->findById($id);

        if (!$oldQuestion) {
            $newQuestion = null;
            $statusCode = 404;
        } else {
            $newQuestion = $this->questionRepository->update($request, $oldQuestion);
            $statusCode = 200;
        }

        return [
            'statusCode' => $statusCode,
            'question' => $newQuestion
        ];
    }

    public function destroy($id)
    {
        $question = $this->questionRepository->findById($id);

        $statusCode = 404;
        $message = "Answer not found";
        if ($question) {
            $this->questionRepository->destroy($question);
            $statusCode = 200;
            $message = "Delete success!";
        }

        return [
            'statusCode' => $statusCode,
            'message' => $message
        ];
    }
}
