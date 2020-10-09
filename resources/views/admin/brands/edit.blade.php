@extends('admin.layout.master')

@section('head')
    <title>edit the {{$brand->title}} brand</title>
    <link rel="stylesheet" href="{{asset('admin/css/dropzone.min.css')}}">
@endsection


@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">edit the <span class="text-primary">{{$brand->title}}</span> brand</h3>
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
                    you can edit the following inputs
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                {!! Form::model($brand, ['method' => 'PATCH','route' => ['brands.update', $brand->id] , 'id'=>'myForm']) !!}


                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            {!! Form::label('title', 'title') !!}
                            {!! Form::text('title',null, ['class' => 'form-control']) !!}

                        </div>
                    </div>

                    <div class="form-group">

                        @if($brand->media)<img src="{{url('/').$brand->media->path}}" width="150px"
                                               alt="not found" class="mx-5 my-3"> @endif
                    </div>

                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        {!! Form::label('description', 'description') !!}
                        {!! Form::textarea('description',null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        @if($brand->media)
                            {!! Form::label('media_id', 'photo ID: '.$brand->media->id) !!}
                        @endif
                        {!! Form::text('media_id',null, ['class' => 'form-control col-sm-3 mb-3','id'=>'brand-photo']) !!}
                        <div id="photo" class="dropzone"></div>

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


@section('script')
    <script type="text/javascript" src="{{asset('/admin/js/dropzone.min.js')}}"></script>
    <script>

        Dropzone.autoDiscover = false;      // to disable the auto discover behaviour of Dropzone
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            url: "{{route('medias.upload')}}",
            sending: function (file, xhr, formData) {
                formData.append("_token", "{{csrf_token()}}")
            },
            success: function (file, response) {
                document.getElementById('brand-photo').value = response.photo_id
            }
        });
    </script>
@endsection

