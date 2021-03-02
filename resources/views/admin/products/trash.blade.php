@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Products Table</h4>
                            @include('messages')
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($trashedProducts as $product)
                                        <tr>
                                            <td>
                                                {{ $product->id }}
                                            </td>
                                            <td class="text-primary">
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.products.restore',$product->id) }}">Restore</a> |
                                                <a href="{{ route('admin.products.destroy',$product->id) }}" id="deleteButton">Permanently Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <form method="post" id="deleteForm">
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        jQuery(document).ready(function(){
            jQuery('a#deleteButton').click(function(e){
                e.preventDefault();
                let action = jQuery(this).attr('href');
                console.log(action);
                jQuery('#deleteForm').attr('action',action).submit();
            });
        })
    </script>
@endsection
