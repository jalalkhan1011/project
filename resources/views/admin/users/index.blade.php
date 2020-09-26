@extends('admin.layouts.master')


@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Users</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Bordered table  start -->
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h4 class="text-blue">Users</h4>
                </div>
                <div class="pull-right">
                    <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm" role="button"> Create New user</a>
                    <a href="{{ url('/home') }}" class="btn btn-primary btn-sm"  role="button"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
            @if(session('message'))
                <div  class="alert {{ Session('alert-class', 'alert-success','alert-block') }}">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            @if(Auth::user()->hasRole('Admin'))
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 0; @endphp
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">#</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><a href="{{ url('/admin/users/'.$user->id) }}" class="btn btn-primary btn-sm" title="Show"><i class="fa fa-eye"></i> </a> </li>
                                    <li class="list-inline-item"><a href="{{ url('/admin/users/'.$user->id.'/edit') }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-edit"></i> </a> </li>
                                    <li class="list-inline-item">
                                        {!! Form::open(['url' => ['/admin/users/',$user->id], 'method' => 'delete']) !!}
                                        {!! Form::button("<i class='fa fa-trash'></i>",['type' => 'submit', 'onClick' => "return confirm('Are You Want to delete $user->name ?')", 'class' => 'btn btn-sm btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
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
