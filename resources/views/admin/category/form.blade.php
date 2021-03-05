<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><strong>Category</strong><small> Form</small></div>
            <div class="card-body card-block">
                <form action="{{ isset($category)?route('admin.categories.update',$category->id):route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                    @if(isset($category))
                        @method('patch')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Category Name</label>
                                <input name="name" value="{{ $category->name??old('name') }}" type="text" placeholder="Enter your category name" class="form-control @error('name') {{ "is-invalid" }} @enderror" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="model" class=" form-control-label">Active/Inactive</label>
                                <div>
                                    <div class="form-check-inline form-check">
                                        <label for="inline-radio1" class="form-check-label ">
                                            <input type="radio" name="active" value="1" class="form-check-input" {{ isset($category)?($category->active?'checked':''):(old('active')?'checked':'')}}>Active
                                        </label>
                                        <label for="inline-radio2" class="form-check-label ">
                                            <input type="radio" name="active" value="0" class="form-check-input" {{ isset($category)?($category->active?'':'checked'):(old('active')?'':'checked')}}>Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class=" form-control-label">Category Description</label>
                        <textarea name="description" id="textarea-input" rows="9" placeholder="Content..." class="form-control">{!! $category->description??old('description') !!}</textarea>
                    </div>
                    <div class="form-group">
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-plus fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">{{isset($category) ? 'Update ' :'Add '}}Category Now</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
