@extends('admin.layout.master')

@section('head')
    <title>update the {{$attributeGroup->title}} attribute</title>
@endsection


@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">update the {{$attributeGroup->title}} attribute</h3>
                </div><!-- /.col -->
            </div>
        </div>
    </div>
   

    @include('admin.partials.form-errors')

    <div class="col-md-12">

        <div class="card card-warning m-2">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-edit"></i>
                    You can edit the following phrase in the <b>{{$attributeGroup->title}}</b> attribute
                </h3>
            </div>
          
            <div class="card-body">

                {!! Form::model($attributeGroup ,['method' => 'PATCH','route' => ['attributes-group.update', $attributeGroup->id]]) !!}

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        {!! Form::label('title', 'attribute title') !!}
                        {!! Form::text('title',null, ['class' => 'form-control','placeholder' => 'Enter a title ...']) !!}

                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">

                            {!! Form::label('type', 'attribute type') !!}

                            {!! Form::select('type', ['Text' => 'Text','TextArea' => 'Text Area','Price' => 'Price', 'Boolean' => 'Boolean', 'DateTime' => 'Date Time',
                            'singleSelect' => 'single Select', 'multiSelect' => 'multi Select'], null, ['class' => 'form-control','placeholder' => 'Pick a attribute type...']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">

                    {{--will help to return back to the correct url after updating--}}
                    {!! Form::hidden('redirects_to', URL::previous()) !!}
                    {!! Form::submit('submit',['class' => 'btn btn-lg bg-gradient-info']); !!}

                </div>

                {!! Form::close() !!}

            </div>
         
        </div>

    </div>

@endsection
