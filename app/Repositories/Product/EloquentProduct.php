<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentProduct extends EloquentRepository implements BaseRepository,ProductRepository {

    protected $model;

    public function __construct(Product $product){
        $this->model = $product;
    }
}
