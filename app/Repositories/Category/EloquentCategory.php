<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCategory extends EloquentRepository implements BaseRepository, CategoryRepository {

    protected $model;

    public function __construct(Category $category){
        $this->model = $category;
    }

}
