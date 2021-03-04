<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentProduct extends EloquentRepository implements BaseRepository,ProductRepository {

    protected $model;

    public function __construct(Product $product){
        $this->model = $product;
    }

    public function store(Request $request)
    {
        $product = parent::store($request);

        if($request->input('categories'))
            $product->categories()->sync($request->input('categories'));

        if($request->hasFile('images'))
            $product->saveImages($request->file('images'), 'product/'.$product->id);
    }

    public function update(Request $request, $id){
        $product = parent::update($request,$id);

        $product->categories()->sync($request->input('categories'));

        if($request->hasFile('images'))
            $product->saveImages($request->file('images'), 'product/'.$product->id);

        return $product;
    }
}
