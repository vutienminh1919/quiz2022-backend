<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return response()->json($categories, 200);
    }

    public function show($id)
    {
        $data = $this->categoryService->findById($id);
        return response()->json($data['category'], 200);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $this->categoryService->create($request->all());

        return response()->json($data['category'], 201);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $data = $this->categoryService->update($request->all(), $id);

        return response()->json($data['category'], 200);
    }

    public function destroy($id)
    {
//        if ($this->categoryService->isUsedCategoryInQuestionTable($id) || $this->categoryService->isUsedCategoryInQuizTable($id)) {
//            return response()->json(['message' => 'Category already has Questions or Quizzes.', 'error' => 'error'],);
//        } else {
            $this->categoryService->destroy($id);
            return response()->json(['message' => 'Xóa thành công'], 200);
    }


}
