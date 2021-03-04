<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $product->saveImages($request->file('images'), 'images/product/'.$product->id);

        return $product;
    }

    public function destroy($id)
    {
        $product = parent::findTrash($id);// find the product in trash

        $product->images()->delete();// delete related images from database

        Storage::deleteDirectory('public/images/product/'.$id);// delete images from storage

        return parent::destroy($id);// finally delete product
    }
}
