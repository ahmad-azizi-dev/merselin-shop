@extends('admin.layout.master')

@section('head')
    <title>brands list</title>
    <link rel="stylesheet" href="{{asset('admin/css/toastr.css')}}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/responsive.bootstrap4.min.css')}}">

@endsection

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">brands list</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card m-2">
        <div class="card-header">
            <span class="card-title"><i class="fa fa-list"></i></span>
            <div class="text-right">
                <a href="{{route('brands.create')}}" class="btn ntn-app text-primary">
                    add a new brand
                    <i class="fa fa-edit"></i>
                </a>

            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-sm table-striped table-responsive ">
                <thead>
                <tr class="bg-gradient-info">
                    <th style="min-width: 50px !important;">id</th>
                    <th style="min-width: 150px !important;">title</th>
                    <th style="min-width: 200px !important;">description</th>
                    <th style="min-width: 50px !important;">Photo</th>
                    <th style="min-width: 150px !important;">operations</th>
                    <th style="min-width: 150px !important;">created date (Teh)</th>
                    <th style="min-width: 150px !important;">updated date (Teh)</th>
                    <th style="min-width: 150px !important;">update diff</th>
                </tr>
                </thead>
                <tbody>

                @foreach($brands as $brand)
                    <tr>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->title}}</td>
                        <td>{{$brand->description}}</td>
                        <td>@if($brand->media)<img src="{{url('/').'/storage/photos/'.$brand->media->path}}" width="50px" height="50px"
                                                   alt="not found"> @endif </td>

                        <td><a class="btn btn-sm  bg-gradient-warning m-2"
                               href="{{route('brands.edit', $brand->id)}}">edit</a>
                            <div style="display: inline-block !important;" class="row">

                                <button type="button" class="btn btn-sm btn-danger m-2" data-toggle="modal"
                                        data-target="#delete{{$brand->id}}">
                                    delete
                                </button>

                            </div>


                            <!-- The delete Modal -->
                            <div class="modal fade" id="delete{{$brand->id}}">
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
                                                class="text-info">{{$brand->title}} </b>
                                            brand!!
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-block btn-secondary w-50 mr-3"
                                                    data-dismiss="modal">cancel
                                            </button>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['brands.destroy', $brand->id] ]) !!}
                                            {!! Form::submit('delete', ['class'=>'btn bg-gradient-danger m-2']) !!}
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </td>
                        <td> @if($brand->created_at) {{$brand->created_at->setTimezone('Asia/Tehran')}}  @endif </td>
                        <td> @if($brand->updated_at) {{$brand->updated_at->setTimezone('Asia/Tehran')}}  @endif </td>
                        <td> @if($brand->updated_at) {{$brand->updated_at->diffForHumans()}}  @endif </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
    </div>

@endsection

@section('script')

    <script src="{{asset('admin/js/toastr.min.js')}}"></script>


    <!-- DataTables -->

    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>

    @if(Session::has('brand'))
        @include('admin.partials.notification',['notification'=>Session('brand'),'toastr'=>Session('toastr')])
    @endif

@endsection
