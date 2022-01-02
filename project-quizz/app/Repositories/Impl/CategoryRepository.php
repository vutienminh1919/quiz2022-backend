<?php

namespace App\Repositories\Impl;

use App\Models\Category;
use App\Repositories\CategoryRepositoryImpl;
use App\Repositories\Eloquent\EloquentRepository;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryImpl
{
    public function getModel()
    {
        return Category::class;
    }
}
