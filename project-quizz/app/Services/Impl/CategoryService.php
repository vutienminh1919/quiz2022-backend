<?php

namespace App\Services\Impl;



use App\Repositories\CategoryRepositoryImpl;
use App\Services\CategoryServiceImpl;

class CategoryService implements CategoryServiceImpl
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryImpl $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function findById($id)
    {
        $category = $this->categoryRepository->findById($id);

        $statusCode = 200;
        if (!$category) {
            $statusCode = 404;
        }

        return [
            'statusCode' => $statusCode,
            'categories' => $category
        ];
    }

    public function create($request)
    {
        $category = $this->categoryRepository->create($request);

        $statusCode = 201;
        if (!$category) {
            $statusCode = 500;
        }

        return [
            'statusCode' => $statusCode,
            'categories' => $category
        ];
    }

    public function update($request, $id)
    {
        $oldCategory = $this->categoryRepository->findById($id);

        if (!$oldCategory) {
            $newCategory = null;
            $statusCode = 404;
        } else {
            $newCategory = $this->categoryRepository->update($request, $oldCategory);
            $statusCode = 200;
        }

        return [
            'statusCode' => $statusCode,
            'categories' => $newCategory
        ];
    }

    public function destroy($id)
    {
        $category = $this->categoryRepository->findById($id);

        $statusCode = 404;
        $message = "Category not found";
        if ($category) {
            $this->categoryRepository->destroy($category);
            $statusCode = 200;
            $message = "Delete success!";
        }

        return [
            'statusCode' => $statusCode,
            'message' => $message
        ];
    }
}
