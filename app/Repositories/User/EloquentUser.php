<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use App\User;

class EloquentUser extends EloquentRepository implements BaseRepository{

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

}
