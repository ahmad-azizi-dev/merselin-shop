@extends('admin.layout.master')

@section('head')
    <title>add new category</title>
@endsection


@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">add new category</h3>
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

                {!! Form::open(['method' => 'post','route' => 'categories.store','role' => 'form']) !!}

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            {!! Form::label('name', 'name') !!}
                            {!! Form::text('name',null, ['class' => 'form-control','placeholder' => 'Enter a name ...']) !!}

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('slug', 'slug (optional)') !!}
                            {!! Form::text('slug',null, ['class' => 'form-control','placeholder' => 'choose automatically by title if leave empty']) !!}
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
                            {!! Form::label('meta_desc', 'meta description') !!}
                            {!! Form::textarea('meta_desc',null, ['class' => 'form-control','placeholder' => 'Enter a meta description ...','rows' => '3']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">

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
                        <!-- select -->
                        <div class="form-group">

                            {!! Form::label('category_parent', ' parent for this category') !!}

                            <select name="category_parent" id="" class="form-control">
                                <option class="text-danger" value="0">no parent &#10060;</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">&#128309; {{$category->name}}</option>
                                    @if(count($category->childrenRecursive) > 0)
                                        @include('admin.partials.category', ['categories'=>$category->childrenRecursive, 'level'=>1])
                                    @endif
                                @endforeach
                            </select>

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
