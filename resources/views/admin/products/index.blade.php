@extends('layouts.admin')

@section('stylesheet')
    {{--Datatable CSS--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    {{--Exporter CSS--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
@endsection

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
                                <table id="product-table" class="table">
                                    <thead class=" text-primary">
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td><input type="checkbox" data-id="{{ $product->id }}" class="ind-check"></td>
                                            <td>
                                                {{ $product->id }}
                                            </td>
                                            <td class="text-primary">
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.products.edit',$product->id) }}">Edit</a> |
                                                <a href="{{ route('admin.products.trash',$product->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.products.mass.trash') }}" method="post" id="mass-trash-form">
        @csrf
        <input type="hidden" name="ids" id="mass-trash-ids">
    </form>
@endsection

@section('script')
    {{--Datatable Script--}}
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    {{--Exporter Script--}}
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            jQuery('#product-table').DataTable({
                "scrollY": 500,
                dom: 'Bfrtip',
                buttons: [{
                    text: 'Mass Trash',
                    action: function ( e, dt, node, config ) {
                        let ids = [];
                        jQuery('.ind-check:checkbox').each(function(){
                            if(jQuery(this).is(':checked'))
                                ids.push(jQuery(this).data('id'));
                        });
                        if(ids.length === 0){
                            alert('No Products is selected in the current window!');
                            return ;
                        }
                        if(confirm('Are you sure you want to delete the selected products?')){
                            massTrash(ids);
                        }
                    }
                }, 'excel', 'pdf', 'print','pageLength']
            });
            jQuery('#select-all:checkbox').click(function(){
                if(jQuery(this).is(':checked'))
                    jQuery('.ind-check').prop('checked',true);
                else
                    jQuery('.ind-check').prop('checked',false);
            });
            function massTrash(ids){
                jQuery('#mass-trash-ids').val(ids);
                jQuery('#mass-trash-form').submit();
            }
        });
    </script>
@endsection
