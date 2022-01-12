<?php

namespace App\Services;

use App\Repositories\UserQuizRepo;

class UserQuizService implements CRUDinterfaceService
{
    protected $userQuizRepo;
    public function __construct(UserQuizRepo $userQuizRepo)
    {
        $this->userQuizRepo = $userQuizRepo;
    }

    public function getAll()
    {
        return $this->userQuizRepo->getAll();
    }

    public function findById($id)
    {
        $userQuiz = $this->userQuizRepo->findById($id);

        return (!$userQuiz ? abort(404) : $userQuiz);
    }

    public function create($request)
    {
        return $this->userQuizRepo->create($request);
    }

    public function update($id, $request)
    {
        $oldUserQuiz = $this->userQuizRepo->findById($id);

        return (!$oldUserQuiz ? abort(404) : $this->userQuizRepo->update($request,$oldUserQuiz));
    }

    public function destroy($id)
    {
        $userQuiz = $this->userQuizRepo->findById($id);

        return ($userQuiz ? $this->userQuizRepo->destroy($userQuiz) : abort(404));
    }

}
