@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Product Setup</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add NewProduct</h3>
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
                            {!! Form::open(['url' => '/products', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Main Category</label>
                                    <div class="col-sm-4">
                                        <select name="cat_id" class="form-control">
                                            <option value="0">-- Select --</option>
                                            @foreach($category as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Brands</label>
                                    <div class="col-sm-4">
                                        <select name="brand_id" class="form-control">
                                            <option value="0">-- Select --</option>
                                            @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Color</label>
                                    <div class="col-sm-4">
                                        <select name="color_id" class="form-control">
                                            <option value="0">-- Select --</option>
                                            @foreach($colors as $color)
                                            <option value="{{$color->id}}">{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Item Code</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="sku">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Item Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                    <label class="col-sm-2 control-label">Size</label>
                                    <div class="col-sm-4">
                                        <select name="size_id" class="form-control">
                                            <option value="0">-- Select --</option>
                                            @foreach($sizes as $size)
                                            <option value="{{$size->id}}">{{$size->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" name="description"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Sales Price</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="sales_price">
                                    </div>
                                    <label class="col-sm-2 control-label">Status</label>
                                    <div class="field col-sm-4" align="left">
                                        <select name="status" class="form-control">
                                            <option value="1">Publish</option>
                                            <option value="0">Hide</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Image</label>
                                    <div class="field col-sm-10" align="left">
                                      <input type="file" id="files" name="files[]" multiple />
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                {!! Form::submit('Submit ', ['class'=> 'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    
    function add() {
        var sizeId = $('#txtSize').val();
        var size = $('#txtSize option:selected').text();
        var purchasePrice = $("#txtPurchaseAmt").val();
        var salesPrice = $('#txtsalesAmt').val();
        var lessAmt = $('#txtLessAmt').val();
        var valid = validate();
        if (valid == false) {
            return false;
        }
        var html ="<tr>"
            + "<td class='none'><input name='sizes[]' type='text' value='" + sizeId + "' /></td>"
            + "<td><input class='form-control' type='text' value='" + size + "' /></td>"
            + "<td><input name='purchaseprices[]' class='form-control' type='text' value='" + purchasePrice + "' /></td>"
            + "<td><input name='salesprices[]' class='form-control' type='text' value='" + salesPrice + "' /></td>"
            + "<td><input name='lessamts[]' class='form-control' type='text' value='" + lessAmt + "' /></td>"
            + "<td><a href='#' class='deleteRow'><span class='fa fa-trash'></span</a></td>"
            + "</tr>";
        $('#tbody').append(html);
        $(".table-scrollable thead input").val("");
        return false;
    }
    $("table #tbody").on("click", "a.deleteRow", function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
        return false;
    });

    function validate() {
        var isValid = true;
        var table = $("table #tbody");
        var itemId = $("#txtSize").val();
        table.find('tr').each(function (i) {
            var $tds = $(this).find('td'),
                tableValue = $tds.eq(0).text();
            if (tableValue == itemId) {
                alert("Already Exist");
                isValid = false;
            }
        });
        if ($('#txtSize').val() == 0) { alert("Please Select Size."); isValid = false; }
        if ($('#txtPurchaseAmt').val() == 0) { alert("Please add purchase Price."); isValid = false; }
        if ($('#txtsalesAmt').val() == 0) { alert("Please add sales Price."); isValid = false; }
        if ($('#txtLessAmt').val() == '') { $('#txtLessAmt').val(0); }
        return isValid;
    }

    $(document).ready(function() {
      if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
          var files = e.target.files,
            filesLength = files.length;
          for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
              var file = e.target;
              $("<span class=\"pip\">" +
                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                "<br/><span class=\"remove\">Remove image</span>" +
                "</span>").insertAfter("#files");
              $(".remove").click(function(){
                $(this).parent(".pip").remove();
              });
            });
            fileReader.readAsDataURL(f);
          }
        });
      } else {
        alert("Your browser doesn't support to File API")
      }
    });
</script>
@endsection

