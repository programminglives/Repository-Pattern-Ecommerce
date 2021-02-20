<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCart extends EloquentRepository implements BaseRepository{

    protected $model;

    public function __construct(Cart $cart){
        $this->model = $cart;
    }

}
