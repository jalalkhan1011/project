@extends('admin.layouts.master')


@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Roles</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
{{--                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>--}}
                            <li class="breadcrumb-item active" aria-current="page">Roles</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Simple Datatable start -->
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h5 class="text-blue">Roles</h5>
                    <p class="font-14">SM Admin panel</p>
                </div>
                @if(Auth::user()->hasRole('Admin'))
                    <div class="pull-right">
                        @can('role-create')
                            <a href="{{ url('admin/roles/create') }}" class="btn btn-sm btn-primary" role="button" title="Create">Create New Role</a>
                        @endcan
                        <a href="{{ url('/home') }}" class="btn btn-sm btn-primary" role="button" title="Back">Back</a>
                    </div>
            </div>
            @if(session('message'))
                <div  class="alert {{ Session('alert-class', 'alert-success','alert-block') }}">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <div class="row">
                <table class="data-table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 0; @endphp
                    @foreach($roles as $role)
                        <tr>
                            <td class="table-plus">{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ date('d-M-Y',strtotime($role->created_at)) }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ url('/admin/roles/'.$role->id) }}"><i class="fa fa-eye"></i> View</a>
                                        @can('role-edit')
                                            <a class="dropdown-item" href="{{ url('/admin/roles/'.$role->id.'/edit') }}"><i class="fa fa-pencil"></i> Edit</a>
                                        @endcan
                                        @can('role-delete')
                                            {!! Form::open(['url' => ['/admin/roles',$role->id], 'method' => 'delete']) !!}
                                            {!! Form::button("<i class='fa fa-trash'> Delete</i>",['type' => 'submit', 'onClick' => "return Confirm'Are You Want to delete $role->name ?'", "class" => "dropdown-item"]) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            @if(Auth::user()->hasRole(''))
                <div><p style="color: red">Permission Denied</p> </div>
            @endif
        </div>
        <!-- Simple Datatable End -->
    </div>
@endsection
{{--@include('admin.include.js')--}}
<script>
    $("document").ready(function(){
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 3000);
    });
</script>
