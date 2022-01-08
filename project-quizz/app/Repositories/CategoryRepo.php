<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Eloquent\EloquentRepo;
use Illuminate\Support\Facades\DB;

class CategoryRepo extends EloquentRepo implements CRUDinterfaceRepo
{
    public function getModel()
    {
        return Category::class;
    }

    public function latest()
    {
        return DB::table('categories')->latest('id')->first();
    }

}
