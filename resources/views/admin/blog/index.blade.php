@extends('admin.master.layout')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog Post</h3>
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
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">ID</th>
                                        <th class="col-md-3">Title</th>
                                        <th class="col-md-3">description</th>
                                        <th class="col-md-3">image</th>
                                        <th class="col-md-2" colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($blogs as $index => $blog)
                                    <tr> 
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ str_limit(strip_tags($blog->details), 130) }}</td>
                                        <td><img src="/{{ $blog->image }}" height="150" alt=""></td>
                                        <td class="align-middle">
                                            @can('blog-edit')
                                            <a class="btn btn-sm btn-primary" href="{{ url('/blogs/'.$blog->id.'/edit') }}">Edit</a>
                                            @endcan
                                        </td>
                                        <td class="align-middle">
                                            @can('blog-delete')
                                            {!! Form::open([ 'method' => 'Delete', 'url' => ['/blogs', $blog->id]]) !!}
                                            {!! Form::submit('Delete',['class'=>'btn btn-sm btn-danger']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                <?php echo $blogs->render(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="/blogs/create" class="btn btn-sm btn-warning pull-right">Add New</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection