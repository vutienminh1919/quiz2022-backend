<?php

namespace App\Http\Controllers;

use App\Services\CategoryServiceImpl;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceImpl $categoryService)
    {
        $this->categoryService= $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return response()->json($categories, 200);
    }

    public function show($id)
    {
        $dataCategory = $this->categoryService->findById($id);
        return response()->json($dataCategory['categories'], $dataCategory['statusCode']);
    }

    public function store(Request $request)
    {
        $dataCategory = $this->categoryService->create($request->all());
        return response()->json($dataCategory['categories'],$dataCategory['statusCode']);
    }

    public function update(Request $request, $id)
    {
        $dataCategory = $this->categoryService->update($request->all(), $id);
        return response()->json($dataCategory['categories'],$dataCategory['statusCode']);
    }

    public function destroy($id)
    {
        $dataCategory = $this->categoryService->destroy($id);
        return response()->json($dataCategory['message'],$dataCategory['statusCode']);

    }
}
