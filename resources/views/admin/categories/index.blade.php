@extends('admin.layout.master')

@section('head')
    <title>categories list</title>
    <link rel="stylesheet" href="{{asset('admin/css/toastr.css')}}">

@endsection


@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">categories list</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="col-md-12">


        <div class="card">
            <div class="card-header">
                <span class="card-title"><i class="fa fa-list"></i></span>
                <div class="text-right">
                    <a href="{{route('categories.create')}}" class="btn ntn-app text-primary">
                        add new category
                        <i class="fa fa-edit"></i>
                    </a>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-sm table-striped table-responsive">
                    <thead>
                    <tr>
                        <th style="min-width: 100px !important;">id</th>
                        <th style="min-width: 250px !important;">name</th>
                        <th style="min-width: 250px !important;">operations</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>&#128309; {{$category->name}}</td>
                            <td style="min-width: 230px !important;">

                                <a class="btn btn-sm  bg-gradient-warning m-2"
                                   href="{{route('categories.indexSetting', $category->id)}}">Setting</a>

                                <button type="button" class="btn btn-sm  bg-gradient-info m-2" data-toggle="modal"
                                        data-target="#details{{$category->id}}">
                                    details
                                </button>
                                </span>

                                <button type="button" class="btn btn-sm btn-danger m-2" data-toggle="modal"
                                        data-target="#myModal{{$category->id}}">
                                    delete
                                </button>
                                </span>


                                <!-- The details Modal -->
                                <div class="modal fade" id="details{{$category->id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-info"><i class="fa fa-newspaper"></i>
                                                    details</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <table class="table-bordered table-sm table-striped table-responsive">
                                                    <tbody>
                                                    <tr>
                                                        <th style="min-width: 180px !important;">id</th>
                                                        <td style="min-width: 580px !important;">{{$category->id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>name</th>
                                                        <td>{{$category->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>meta title</th>
                                                        <td>{{$category->meta_title}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>slug</th>
                                                        <td>{{$category->slug}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>meta description</th>
                                                        <td>{{$category->meta_desc}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>meta keywords</th>
                                                        <td>{{$category->meta_keywords}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>parent ID</th>
                                                        <td>{{$category->parent_id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>attributes</th>
                                                        <td>
                                                            <ul>
                                                                @foreach($category->attributeGroups as $attributeGroup)
                                                                    <li>  {{$attributeGroup->title}}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>created date (Tehran)</th>
                                                        <td>{{$category->created_at->setTimezone('Asia/Tehran')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>updated date (Tehran)</th>
                                                        <td>{{$category->updated_at->setTimezone('Asia/Tehran')}}</td>
                                                    </tr>

                                                    </tbody>
                                                </table>

                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-block btn-secondary w-25 mr-3"
                                                        data-dismiss="modal">Ok
                                                </button>

                                                <a class="btn btn-block  bg-gradient-warning m-2 w-25"
                                                   href="{{route('categories.edit', $category->id)}}">edit</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- The delete Modal -->
                                <div class="modal fade" id="myModal{{$category->id}}">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-danger"><i class="fa fa-window-close"></i>
                                                    danger!</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                are you sure that want to delete the <b
                                                    class="text-info">{{$category->name}} </b>
                                                category!!
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-block btn-secondary w-50 mr-3"
                                                        data-dismiss="modal">cancel
                                                </button>

                                                {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id] ]) !!}
                                                {!! Form::hidden('currentpage', $categories->currentpage()) !!}
                                                {!! Form::submit('delete', ['class'=>'btn bg-gradient-danger mx-2']) !!}
                                                {!! Form::close() !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>

                        @if(count($category->childrenRecursive) > 0)
                            @include('admin.partials.category_list', ['categories'=>$category->childrenRecursive, 'level'=>1])
                        @endif

                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <div class="text-center">{{$categories->withQueryString()->links()}}</div>

                <div class="col-sm-6">
                    {!! Form::open(['method' => 'get','route' => 'categories.index','class'=>'form-inline']) !!}
                    <div class="form-group mb-2">

                        {!! Form::select('PerPage', ['1' => '1 ','2' => '2 ','3' => '3','5' => '5','7' => '7','10' => '10','15' => '15','20' => '20','40' => '40'],
                        Session('PerPageCategory'),['class' => 'form-control', 'data-toggle'=>'tooltip','title'=>'category per page','data-placement'=>'bottom']) !!}

                        {!! Form::submit('show',['class' => 'btn btn-success m-1']) !!}
                        {!! Form::close() !!}
                    </div>

                </div>

            </div>
        </div>
        <!-- /.card -->
    </div>

@endsection

@section('script')

    <script src="{{asset('admin/js/toastr.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    @if(Session::has('category'))
        @include('admin.partials.notification',['notification'=>Session('category'),'toastr'=>Session('toastr')])
    @endif

@endsection
