<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $product;
    private $model;

    public function __construct(ProductRepository $product){
        $this->model = trans('app.model.product');
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->product->store($request);

        return redirect(route('admin.products.index'))->with('success', trans('messages.created', ['model' => $this->model]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id,['categories']);

        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $this->product->update($request,$id);

        return back()->with(trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Put in trash
     * @param Request $request
     * @param $id
     */
    public function trash(Request $request, $id){
        $this->product->trash($id);

        return back()->with('success',trans('messages.trashed',['model' => $this->model]));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id){
        $this->product->restore($id);

        return back()->with('Success', trans('message.restored', ['model' => $this->model]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product->destroy($id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function massTrash(Request $request){
        $this->product->massTrash($request->ids);
        return back()->with('Success', trans('messages.trashed', ['model' => $this->model]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function massDestroy(Request $request){
        $this->product->massDestroy($request->ids);

        return back()->with('Success', trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function emptyTrash(){
        $this->product->emptyTrash();

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }
}
