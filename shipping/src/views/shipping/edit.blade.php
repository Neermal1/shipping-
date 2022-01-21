@extends('theme::layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/dropzone/min/dropzone.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Shipping</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Update Shipping</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update Shipping</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>


            <!-- /.card-header -->
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="font-size: smaller;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="row form" method="post" action="{{ route('shippings.update',$shipping->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="col-md-7">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Shipping Param Configuration</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="parameter">Parameter</label>
                                    <select class="form-control" name="shipping_param">
                                        @foreach (\Bsdev\Shipping\Models\Shipping::SHIPPING_PARAM as $param)
                                        <option value="{{ $param }}"
                                            {{ $shipping->shipping_param==$param?'selected':'' }}>
                                            {{ $param }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="parameter_min">Parameter Min</label>
                                    <input type="text" name="shipping_param_min"
                                        value="{{ $shipping->shipping_param_min }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="parameter_max">Parameter Max</label>
                                    <input type="text" name="shipping_param_max"
                                        value="{{ $shipping->shipping_param_max }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Shipping Time Configuration</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="parameter">Parameter</label>
                                    <select class="form-control" name="time_param">
                                        @foreach (\Bsdev\Shipping\Models\Shipping::TIME_PARAM as $param)
                                        <option value="{{ $param }}" {{ $shipping->time_param==$param?'selected':'' }}>
                                            {{ $param }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="parameter_min">Parameter Min</label>
                                    <input type="text" name="time_param_min" value="{{ $shipping->time_param_min }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="parameter_max">Parameter Max</label>
                                    <input type="text" name="time_param_max" value="{{ $shipping->time_param_max }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="district">Method</label>
                            <select name="shipping_method_id" class="form-control select2">
                                @foreach(Shipping::getMethods() as $method)
                                <option value="{{ $method->id }}"
                                    {{ ($shipping->shipping_method_id==$method->id)?'selected':'' }}>
                                    {{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cost">Cost</label>
                            <input type="text" name="cost" value="{{ $shipping->cost }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="district">Clusters <small>(multiselect)</small></label>
                            <select name="clusters[]" class="form-control select2" multiple>
                                @foreach(Shipping::getClusters() as $cluster)
                                <option value="{{ $cluster->id }}"
                                    {{ (in_array($cluster->id,$shipping->clusters->pluck('id')->toArray()??[]))?'selected':'' }}>
                                    {{ $cluster->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Publish</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="status" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success"
                                    {{ ($shipping->status)?'checked':'' }}>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-danger float-right" onclick="$('.form')[0].reset()">Reset</a>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </form>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@push('js')
<script src="{{ asset('theme') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="{{ asset('theme') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="{{ asset('theme') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
    $('.shipping-menu').removeClass('menu-is-opening menu-open');
        $('.shipping-menu').addClass('menu-is-opening menu-open');
        $('.shipping-menu').find('>:first-child').removeClass('active');
        $('.shipping-menu').find('>:first-child').addClass('active');
    $(function(){
        $('.select2').select2({
        theme: 'bootstrap4'
        })
        $('#description').summernote({
            height:"300px"
        });
        $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
        bsCustomFileInput.init();
        $('.file-input').change(function(){
        var file = $(this).get(0).files[0];
        
        if(file){
        var reader = new FileReader();
        
        reader.onload = function(){
        $(".preview").attr("src", reader.result);
        }
        
        reader.readAsDataURL(file);
        }
        else {
            $(".preview").attr("src",'');
        }
        });
    });
</script>
@endpush