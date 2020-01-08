
    <div class="form-group">
        {!! Form::label('title','Title',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('title',isset($blog->title) ? $blog->title : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('details', 'Description', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('details',isset($blog->details) ? $blog->details : null,['class'=> 'form-control details']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Image</label>
        <div class="col-sm-10">
            {!! Form::file('image',['class'=>'form-control']) !!} 
        </div>
    </div>
    <div class="form-group text-center">
        {!! Form::submit('Submit ', ['class'=> 'btn green']) !!}
    </div>