<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentOrder extends EloquentRepository implements BaseRepository,OrderRepository {

    protected $model;

    public function __construct(Order $order){
        $this->model = $order;
    }
}
