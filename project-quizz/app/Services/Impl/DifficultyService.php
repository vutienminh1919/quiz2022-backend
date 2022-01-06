<?php

namespace App\Services\Impl;

use App\Repositories\Impl\DifficultyRepository;

class DifficultyService
{
    protected $difficultyRepository;

    public function __construct(DifficultyRepository $difficultyRepository)
    {
        $this->difficultyRepository = $difficultyRepository;
    }

    public function getAll()
    {
        return $this->difficultyRepository->getAll();
    }

    public function findById($id)
    {
        $difficulty = $this->difficultyRepository->findById($id);

        $statusCode = 200;
        if (!$difficulty)
        {
            $statusCode = 400;
        }

        return [
          'statusCode' => $statusCode,
          'difficulty' => $difficulty,
        ];
    }

    public function create($request)
    {
        $difficulty = $this->difficultyRepository->create($request);

        $statusCode = 200;
        if (!$difficulty)
        {
            $statusCode = 400;
        }

        return [
          'statusCode' => $statusCode,
          'difficulty' => $difficulty
        ];
    }

    public function update($request, $id)
    {
        $oldDifficulty = $this->difficultyRepository->findById($id);

        if (!$oldDifficulty) {
            $newDifficulty = null;
            $statusCode = 404;
        } else {
            $newDifficulty = $this->difficultyRepository->update($request, $oldDifficulty);
            $statusCode = 200;
        }

        return [
            'statusCode' => $statusCode,
            'difficulty' => $newDifficulty
        ];
    }

    public function destroy($id)
    {
        $difficulty = $this->difficultyRepository->findById($id);

        $statusCode = 404;
        $message = "Answer not found";
        if ($difficulty) {
            $this->difficultyRepository->destroy($difficulty);
            $statusCode = 200;
            $message = "Delete success!";
        }

        return [
            'statusCode' => $statusCode,
            'message' => $message
        ];
    }
}
