@extends('admin.layout.master')

@section('head')
    <title>attributes list</title>
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
                    <h1 class="m-0 text-dark">attributes list</h1>
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
                <a href="{{route('attributes-group.create')}}" class="btn ntn-app text-primary">
                    add new attribute
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
                    <th style="min-width: 200px !important;">title</th>
                    <th style="min-width: 100px !important;">type</th>
                    <th style="min-width: 150px !important;">operations</th>
                    <th style="min-width: 150px !important;">created date (Teh)</th>
                    <th style="min-width: 150px !important;">updated date (Teh)</th>
                </tr>
                </thead>
                <tbody>

                @foreach($attributesGroup as $attribute)
                    <tr>
                        <td>{{$attribute->id}}</td>
                        <td>{{$attribute->title}}</td>
                        <td>{{$attribute->type}}</td>
                        <td>

                            <a class="btn btn-sm  bg-gradient-warning m-2"
                               href="{{route('attributes-group.edit', $attribute->id)}}">edit</a>
                            <div style="display: inline-block !important;" class="row">

                                <button type="button" class="btn btn-sm btn-danger m-2" data-toggle="modal"
                                        data-target="#delete{{$attribute->id}}">
                                    delete
                                </button>


                            </div>


                            <!-- The delete Modal -->
                            <div class="modal fade" id="delete{{$attribute->id}}">
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
                                                class="text-info">{{$attribute->title}} </b>
                                            attribute!!
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-block btn-secondary w-50 mr-3"
                                                    data-dismiss="modal">cancel
                                            </button>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['attributes-group.destroy', $attribute->id] ]) !!}
                                            {!! Form::submit('delete', ['class'=>'btn bg-gradient-danger m-2']) !!}
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </td>
                        <td> @if($attribute->created_at) {{$attribute->created_at->setTimezone('Asia/Tehran')}}  @endif </td>
                        <td> @if($attribute->updated_at) {{$attribute->updated_at->setTimezone('Asia/Tehran')}}  @endif </td>
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

    @if(Session::has('attribute'))
        @include('admin.partials.notification',['notification'=>Session('attribute'),'toastr'=>Session('toastr')])
    @endif

@endsection
