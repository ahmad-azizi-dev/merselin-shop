@extends('admin.layout.master')

@section('head')
    <title>add new product</title>
@endsection


@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">add new product</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @include('admin.partials.form-errors')

    <div class="col-md-12">

        <!-- general form elements disabled -->
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
                            {!! Form::text('title',null, ['class' => 'form-control','placeholder' => 'Enter a title ...']) !!}

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('slug', 'slug (optional)') !!}
                            {!! Form::text('slug',null, ['class' => 'form-control','placeholder' => 'choose automatically by meta title if leave empty']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                            {!! Form::label('meta_title', 'meta title') !!}
                            {!! Form::textarea('meta_title',null, ['class' => 'form-control','placeholder' => 'Enter a meta title ...','rows' => '3']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('description', 'description') !!}
                            {!! Form::textarea('description',null, ['class' => 'form-control','placeholder' => 'Enter a meta description ...','rows' => '3']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('meta_desc', 'meta description') !!}
                            {!! Form::textarea('meta_desc',null, ['class' => 'form-control','placeholder' => 'Enter a meta description ...','rows' => '3']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                            {!! Form::label('meta_keywords', 'meta keywords') !!}
                            {!! Form::textarea('meta_keywords',null, ['class' => 'form-control','placeholder' => 'Enter a meta keywords ...','rows' => '3']) !!}
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('price', 'price (T)') !!}
                            {!! Form::number('price',null, ['class' => 'form-control','placeholder' => 'Enter a meta price ...']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                            {!! Form::label('discount_price', 'discount price (T)') !!}
                            {!! Form::number('discount_price',null, ['class' => 'form-control','placeholder' => 'Enter a discount_price ...']) !!}
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">

                            {!! Form::label('category_parent', 'categories') !!}

                            <select name="category" class="form-control">
                                <option class="text-danger" value="">select categories for this product ...</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">&#128309; {{$category->name}}</option>
                                    @if(count($category->childrenRecursive) > 0)
                                        @include('admin.partials.category', ['categories'=>$category->childrenRecursive, 'level'=>1])
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('status', 'status') !!}
                            {!! Form::select('status', ['0' => 'Unpublished &#10060;', '1' => 'published &#9989;'], null, ['placeholder' => 'Select a status...','class' => 'form-control']) !!}
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">

                            {!! Form::label('brand_id', 'brand') !!}

                            {!! Form::select('brand_id', $brands , null, ['class' => 'form-control','placeholder' => 'Pick a brand ...']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">

                    {!! Form::submit('submit',['class' => 'btn btn-lg bg-gradient-info']); !!}

                </div>

                {!! Form::close() !!}

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- general form elements disabled -->
    </div>

@endsection