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

        if($request->hasFile('image'))
            $product->saveImage($request->file('image'));
    }

    public function update(Request $request, $id){
        $product = parent::update($request,$id);

        $product->categories()->sync($request->input('categories'));

        if($request->hasFile('image') || ($request->input('delete_image') == 1))
            $product->deleteImage();

        if($request->hasFile('image'))
            $product->saveImage($request->file('image'));

        return $product;
    }
}
