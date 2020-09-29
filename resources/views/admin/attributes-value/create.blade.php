@extends('admin.layout.master')

@section('head')
    <title>add new attribute value</title>
@endsection


@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">add new attribute value</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @include('admin.partials.form-errors')

    <div class="col-md-12">

        <div class="card card-warning m-2">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-edit"></i>
                    Please enter the following inputs
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                {!! Form::open(['method' => 'post','route' => 'attributes-value.store']) !!}


                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">

                            {!! Form::label('attributeGroup_id', 'attribute Group') !!}

                            {!! Form::select('attributeGroup_id', $attributesGroup , null, ['class' => 'form-control','placeholder' => 'Pick a attribute group...']) !!}

                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        {!! Form::label('title', 'attribute value') !!}
                        {!! Form::text('title',null, ['class' => 'form-control','placeholder' => 'Enter a value ...']) !!}

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

    </div>

@endsection
