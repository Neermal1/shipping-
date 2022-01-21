@extends('theme::layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cluster</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Cluster</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cluster List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {{$dataTable->table()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="{{ asset('theme') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('theme') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('theme') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('theme') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('theme') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('theme') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('theme') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('theme') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('theme') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('theme') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('theme') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('theme') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{$dataTable->scripts()}}
<script>
    $('.shipping-menu').removeClass('menu-is-opening menu-open');
        $('.shipping-menu').addClass('menu-is-opening menu-open');
        $('.shipping-menu').find('>:first-child').removeClass('active');
        $('.shipping-menu').find('>:first-child').addClass('active');
    $(function(){
    $(document).on('click','.delete-class',function(e){
        e.preventDefault();
        if(confirm('Are you sure want to delete??')){
            console.log($(this).parent().submit());
        }
    });
})
</script>
@endpush