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
                                    @foreach($trashedProducts as $product)
                                        <tr>
                                            <td><input type="checkbox" data-id="{{ $product->id }}" class="ind-check"></td>
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
    <form action="{{ route('admin.products.mass.restore') }}" method="post" id="mass-restore-form">
        @csrf
        <input type="hidden" name="ids" id="mass-restore-ids">
    </form>
    <form action="{{ route('admin.products.trash.empty') }}" method="get" id="empty-trash-form">
        @csrf
    </form>
    <form action="{{ route('admin.products.mass.destroy') }}" method="post" id="mass-destroy-form">
        @csrf
        <input type="hidden" name="ids" id="mass-destroy-ids">
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
        jQuery(document).ready(function(){
            jQuery('#product-table').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    text: 'Mass Restore',
                    action: function ( e, dt, node, config ) {
                        let ids = getIds();
                        if(ids.length === 0){
                            alert('No Products is selected in the current window!');
                            return ;
                        }
                        if(confirm('Are you sure you want to restore the selected products?')){
                            massRestore(ids);
                        }
                    }
                },{
                    text: 'Mass Delete',
                    action: function ( e, dt, node, config ) {
                        let ids = getIds();
                        if(ids.length === 0){
                            alert('No Products is selected in the current window!');
                            return ;
                        }
                        if(confirm('Are you sure you want to permanently delete the selected products?')){
                            massDestroy(ids);
                        }
                    }
                },{
                    text: 'Empty Trash',
                    action: function ( e, dt, node, config ) {
                        if(confirm('Are you sure you want to permanently delete the selected products?')){
                            jQuery('#empty-trash-form').submit();
                        }
                    }
                },'excel', 'pdf', 'print'
                ]
            });
            jQuery('a#deleteButton').click(function(e){
                e.preventDefault();
                let action = jQuery(this).attr('href');
                console.log(action);
                jQuery('#deleteForm').attr('action',action).submit();
            });
            jQuery('#select-all:checkbox').click(function(){
                if(jQuery(this).is(':checked'))
                    jQuery('.ind-check').prop('checked',true);
                else
                    jQuery('.ind-check').prop('checked',false);
            });
            function massRestore(ids){
                jQuery('#mass-restore-ids').val(ids);
                jQuery('#mass-restore-form').submit();
            }
            function massDestroy(ids){
                jQuery('#mass-destroy-ids').val(ids);
                jQuery('#mass-destroy-form').submit();
            }
            function getIds(){
                let ids = [];
                jQuery('.ind-check:checkbox').each(function(){
                    if(jQuery(this).is(':checked'))
                        ids.push(jQuery(this).data('id'));
                });
                return ids;
            }
        })
    </script>
@endsection
