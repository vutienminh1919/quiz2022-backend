<?php

namespace App\Services;

use App\Repositories\CategoryRepo;

class CategoryService implements CRUDinterfaceService
{
    protected $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAll()
    {
        return $this->categoryRepo->getAll();
    }

    public function findById($id)
    {
        $category = $this->categoryRepo->findById($id);

        if (!$category) {
            return 404;
        }
        return ['category' => $category];
    }

    public function create($request)
    {
        $category = $this->categoryRepo->create($request);

        if (!$category) {
            return 500;
        }
        return ['category' => $category];
    }

    public function update($request, $id)
    {
        $oldCategory = $this->categoryRepo->findById($id);

        if (!$oldCategory) {
            $newCategory = null;
            return 404;
        } else {
            $newCategory = $this->categoryRepo->update($request, $oldCategory);
        }
        return [
            'category' => $newCategory
        ];
    }


    public function destroy($id)
    {
        $category = $this->categoryRepo->findById($id);

        if ($category) {
            return $this->categoryRepo->destroy($id);
        }

        return 404;
    }

    public function isUsedCategoryInQuestionTable($id)
    {
        $category = $this->categoryRepo->findById($id);
        return ($category->questions->first());
    }

    public function isUsedCategoryInQuizTable($id)
    {
        $category = $this->categoryRepo->findById($id);
        return ($category->quizzes->first());
    }

    public function latest()
    {
        return $this->categoryRepo->latest();
    }

}
