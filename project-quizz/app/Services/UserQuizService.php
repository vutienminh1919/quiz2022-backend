<?php

namespace App\Services;



use App\Repositories\UserQuizRepo;

class UserQuizService
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

        return $userQuiz;
    }

    public function create($request)
    {
        return $this->userQuizRepo->create($request);
    }

    public function update($id, $request)
    {
        $oldUserQuiz = $this->userQuizRepo->findById($id);

       $this->userQuizRepo->update($request,$oldUserQuiz);
    }

    public function destroy($id)
    {
        $userQuiz = $this->userQuizRepo->findById($id);
        $this->userQuizRepo->destroy($userQuiz);
    }
}
