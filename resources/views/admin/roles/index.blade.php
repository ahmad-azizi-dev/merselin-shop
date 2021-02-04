@extends('admin.layout.master')

@section('head')
    <title>roles list</title>
@endsection

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">roles list</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="card-title"><i class="fa fa-list"></i></span>
                <div class="text-right">
                    <button type="button" class="btn btn-sm  bg-gradient-info m-2" data-toggle="modal"
                            data-target="#newSlide">
                        add new role <i class="fa fa-edit"></i>
                    </button>
                </div>
                @include('admin.roles.add-new-role-modal')
            </div>
            @livewire('admin.roles.roles-index')
            <div class="card-footer clearfix">
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @livewireScripts
    <script type="text/javascript">
        function refreshModal() {
            $('.modal.edit').on('hide.bs.modal', function () {
                Livewire.emit('refreshRolesIndex');
            })
        }

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('message.processed', () => {
                refreshModal();
            })
        });
        refreshModal();
    </script>
@endsection
