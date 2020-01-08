@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Role Managment</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Role Managment</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    @if (Session::has('message'))
                        <div class="text-center alert-danger">{{ Session::get('message') }}</div>
                    @endif
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <table class="table table-bordered">
                          <tr>
                             <th>No</th>
                             <th>Name</th>
                             <th width="280px">Action</th>
                          </tr>
                            @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                    @can('role-edit')
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                    @endcan
                                    @can('role-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                    <div class="box-footer clearfix">
                        <a href="{{route('roles.create')}}" class="btn btn-sm btn-warning pull-right">Add New</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

