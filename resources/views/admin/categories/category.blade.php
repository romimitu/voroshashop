@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Category Setup</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Main Category</h3>
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
                            <div class="col-md-12">
                                <ul id="tree1">
                                @foreach($categories as $category)
                                    <li>
                                        {{ $category->name }} <a class="tree-action" href="{{ url('/category/'.$category->id.'/edit') }}">(view)</a>
                                        @if(count($category->childs))
                                            @include('admin.categories.childs',['childs' => $category->childs])
                                        @endif
                                    </li> 
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="javascript:;" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#addMainCat">Add New</a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addMainCat">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Category</h5>
                                </div>
                                {!! Form::open(['url' => '/category', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Parent Category</label>
                                        <div class="col-sm-8">
                                            {!! Form::select('parent_id',$allCategories, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Status</label>
                                        <div class="col-sm-8">
                                            <select name="status" class="form-control">
                                                <option value="1">Publish</option>
                                                <option value="0">Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Image</label>
                                        <div class="col-sm-8">
                                            {!! Form::file('image', ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                                    {!! Form::submit('Submit ', ['class'=> 'btn btn-primary']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
    $.fn.extend({
        treed: function (o) {
          
          var openedClass = 'fa-minus-circle';
          var closedClass = 'fa-plus-circle';
          
          if (typeof o != 'undefined'){
            if (typeof o.openedClass != 'undefined'){
            openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined'){
            closedClass = o.closedClass;
            }
          };
          
            //initialize each of the top levels
            var tree = $(this);
            tree.addClass("trees");
            tree.find('li').has("ul").each(function () {
                var branch = $(this); //li with children ul
                branch.prepend("<i class='indicator fa " + closedClass + "'></i>");
                branch.addClass('branch');
                branch.on('click', function (e) {
                    if (this == e.target) {
                        var icon = $(this).children('i:first');
                        icon.toggleClass(openedClass + " " + closedClass);
                        $(this).children().children().toggle();
                    }
                })
                branch.children().children().toggle();
            });
            //fire event from the dynamically added icon
          tree.find('.branch .indicator').each(function(){
            $(this).on('click', function () {
                $(this).closest('li').click();
            });
          });
            //fire event to open branch if the li contains an anchor instead of text
            tree.find('.branch>a').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                });
            });
            //fire event to open branch if the li contains a button instead of text
            tree.find('.branch>button').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                });
            });
        }
    });

    //Initialization of treeviews

    $('#tree1').treed();
</script>
@endsection

