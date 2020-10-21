@extends('admin.layout.master')

@section('head')
    <title>add new product</title>

    <link rel="stylesheet" href="{{asset('admin/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/select2-bootstrap4.min.css')}}">
    @livewireStyles

@endsection

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">add new product</h3>
                </div><!-- /.col -->
            </div>
        </div>
    </div>

    @include('admin.partials.form-errors')

    <div class="col-md-12">

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-edit"></i>
                    Please enter the following inputs
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                {!! Form::open(['method' => 'post','route' => 'products.store','role' => 'form']) !!}

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            {!! Form::label('title', 'title') !!}
                            {!! Form::text('title',null, ['class' => 'form-control'. ($errors->has('title') ? ' is-invalid' : null),'placeholder' => 'Enter a title ...']) !!}

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('status', 'status') !!}
                            {!! Form::select('status', ['0' => 'Unpublished &#10060;', '1' => 'published &#9989;'], null, ['placeholder' => 'Select a status...','class' => 'select2bs4 w-100'. ($errors->has('status') ? ' is-invalid' : null)]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                            {!! Form::label('meta_title', 'meta title') !!}
                            {!! Form::textarea('meta_title',null, ['class' => 'form-control'. ($errors->has('meta_title') ? ' is-invalid' : null),'placeholder' => 'Enter a meta title ...','rows' => '3']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('slug', 'slug (optional)') !!}
                            {!! Form::textarea('slug',null, ['class' => 'form-control'. ($errors->has('slug') ? ' is-invalid' : null),'placeholder' => 'choose automatically by meta title if leave empty','rows' => '3']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::label('description', 'description') !!}
                            {!! Form::textarea('description',null, ['id' => 'textareaDescription']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('meta_desc', 'meta description') !!}
                            {!! Form::textarea('meta_desc',null, ['class' => 'form-control'. ($errors->has('meta_desc') ? ' is-invalid' : null),'placeholder' => 'Enter a meta description ...','rows' => '3']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                            {!! Form::label('meta_keywords', 'meta keywords') !!}
                            {!! Form::textarea('meta_keywords',null, ['class' => 'form-control'. ($errors->has('meta_keywords') ? ' is-invalid' : null),'placeholder' => 'Enter a meta keywords ...','rows' => '3']) !!}
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('price', 'price (T)') !!}
                            {!! Form::number('price',null, ['class' => 'form-control'. ($errors->has('price') ? ' is-invalid' : null),'placeholder' => 'Enter a meta price ...']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('discount_price', 'discount price (T)') !!}
                            {!! Form::number('discount_price',null, ['class' => 'form-control','placeholder' => 'Enter a discount_price ...']) !!}
                        </div>
                    </div>

                </div>

                @livewire('admin.products.create-products', ['categories' => $categories])

                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            {!! Form::label('brand_id', 'brand') !!}
                            {!! Form::select('brand_id', $brands , null, ['class' => 'select2bs4 w-100'. ($errors->has('brand_id') ? ' is-invalid' : null),'placeholder' => 'Pick a brand ...']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">

                    @livewire('admin.products.product-photos')

                </div>

                <div class="form-group">

                    {!! Form::submit('submit',['class' => 'btn btn-lg bg-gradient-info']); !!}

                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection

@section('script')

    @livewireScripts

    <script src="{{asset('admin/js/select2.full.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/ckeditor/ckeditor.js')}}"></script>

    <script>

        CKEDITOR.replace('textareaDescription', {
            customConfig: 'config.js',
            toolbar: 'simple',
            language: 'fa',
            removePlugins: 'cloudservices, easyimage'
        })

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('message.processed', (message, component) => {
                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
            })
        });

    </script>
@endsection
