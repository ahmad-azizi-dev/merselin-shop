@extends('admin.layout.master')

@section('head')
    <title>setting for the {{$category->name}} category</title>
@endsection


@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">setting for the <span class="text-danger">{{$category->name}} </span>
                        category</h3>
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
                    Please select the following input
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                {!! Form::open(['method' => 'post','route' => ['categories.saveSetting', $category->id] ]) !!}


                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">

                            {!! Form::label('attributeGroups', 'attributes for the "' .$category->name. '" category') !!}

                            <select name="attributeGroups[]" id="" class="form-control" multiple size="20">
                                @foreach($attributeGroups as $attributeGroup)
                                    <option value="{{$attributeGroup->id}}"
                                            @if(in_array($attributeGroup->id, $category->attributeGroups->pluck('id')->toArray())) class="text-primary text-bold"
                                            selected @endif>{{$attributeGroup->title}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>

                <div class="form-group">

                    {{--will help to return back to the correct page number after updating--}}
                    {!! Form::hidden('redirects_to', URL::previous()) !!}

                    {!! Form::submit('apply',['class' => 'btn btn-lg bg-gradient-info']); !!}

                </div>

                {!! Form::close() !!}

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- general form elements disabled -->
    </div>

@endsection
