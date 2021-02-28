<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><strong>Product</strong><small> Form</small></div>
            <div class="card-body card-block">
                <form action="{{ route('admin.products.store') }}" method="post" class="dropzone" id="mydropzone" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Product Name</label>
                                <input name="name" value="{{ $product->name??old('name') }}" type="text" placeholder="Enter your product name" class="form-control @error('name') {{ "is-invalid" }} @enderror" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price" class=" form-control-label">Price</label>
                                <div class="input-group">
                                    <div class="input-group-addon">NRs.</div>
                                    <input type="number" value="{{ $product->price??old('price') }}" name="price" placeholder="Enter Price Here" class="form-control" required>
                                    <div class="input-group-addon">.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand" class=" form-control-label">Brand Name</label>
                                <input type="text" value="{{ $product->brand??old('brand') }}" name="brand" placeholder="Enter Brand Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="model" class=" form-control-label">Model Name</label>
                                <input type="text" value="{{ $product->model??old('model') }}" name="model" placeholder="Enter Model Name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class=" form-control-label">Product Description</label>
                        <textarea name="description" id="textarea-input" rows="9" placeholder="Content..." class="form-control">{!! $product->description??old('description') !!}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="street" class="form-control-label">Select Categories</label>
                                <select name="categories[]" data-placeholder="Press here to choose categories" multiple class="standardSelect">
                                    <option value="" label="default"></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ in_array($category->id,old('categories')??(isset($product)?$product->categories->pluck('id')->toArray():[]))?'selected':'' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="model" class=" form-control-label">Active/Inactive</label>
                                <div>
                                    <div class="form-check-inline form-check">
                                        <label for="inline-radio1" class="form-check-label ">
                                            <input type="radio" name="active" value="1" class="form-check-input" {{ isset($product)?($product->active?'checked':''):(old('active')?'checked':'')}}>Active
                                        </label>
                                        <label for="inline-radio2" class="form-check-label ">
                                            <input type="radio" name="active" value="0" class="form-check-input" {{ isset($product)?($product->active?'':'checked'):(old('active')?'':'checked')}}>Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dropzonePreview"></div>
                    <div class="form-group">
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-plus fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">Add Product Now</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
