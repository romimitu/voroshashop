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
                        <h3 class="box-title">Edit Product</h3>
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
                            {!! Form::open(['url' => ['/products', $product->id], 'method' =>'PATCH', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Main Category</label>
                                    <div class="col-sm-4">
                                        <select name="cat_id" class="form-control">
                                            <option value="0">-- Select --</option>
                                            @foreach($category as $cat)
                                            <option value="{{$cat->id}}" {{$product->cat_id == $cat->id  ? 'selected' : ''}}>{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                        <input class="none" name="product_id" type="text" value="{{$product->id}}">
                                    </div>
                                    <label class="col-sm-2 control-label">Brands</label>
                                    <div class="col-sm-4">
                                        <select name="brand_id" class="form-control">
                                            <option value="0">-- Select --</option>
                                            @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" {{$product->brand_id == $brand->id  ? 'selected' : ''}}>{{$brand->name}}</option>
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
                                            <option value="{{$color->id}}" {{$product->color_id == $color->id  ? 'selected' : ''}}>{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Item Code</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('sku',isset($product->sku) ? $product->sku : null, ['class'=> 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Item Name</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('title',isset($product->title) ? $product->title : null, ['class'=> 'form-control']) !!}
                                    </div>
                                    <label class="col-sm-2 control-label">Stock</label>
                                    <div class="col-sm-2">
                                        {!! Form::select('in_stock', [1 => 'In Stock', 0 => 'Stock Out'], isset($product->in_stock) ? $product->in_stock : null, ['class'=> 'form-control']); !!}
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        {!! Form::textarea('description', isset($product->description) ? $product->description : null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-3"> Size </th>
                                                    <th class="col-sm-2"> Purchase Price </th>
                                                    <th class="col-sm-2"> Sales Price </th>
                                                    <th class="col-sm-2"> Less Amount </th>
                                                    <th class="col-sm-1"> Action </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" id="txtSize">
                                                            <option value="0">-- Select --</option>
                                                            @foreach($sizes as $size)
                                                            <option value="{{$size->id}}">{{$size->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" id="txtPurchaseAmt"/>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" id="txtsalesAmt" />
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" id="txtLessAmt" value="0" />
                                                    </td>
                                                    <td><button type="button" class="btn btn-sm btn-blue" id="btnAdd" onclick="add()">Add</button></td>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                
                                            @if($product->productDetail->count() > 0)
                                            @foreach($product->productDetail as $detail)
                                                <tr>
                                                    <td class="none"><input name="sizes[]" type="text" value="{{$detail->size->id}}"></td>
                                                    <td><input class="form-control" type="text" value="{{$detail->size->name}}"></td>
                                                    <td><input name="purchaseprices[]" class="form-control" type="text" value="{{$detail->purchase_price}}"></td>
                                                    <td><input name="salesprices[]" class="form-control" type="text" value="{{$detail->sales_price}}"></td>
                                                    <td><input name="lessamts[]" class="form-control" type="text" value="{{$detail->less_amt}}"></td>
                                                    <td><a href="#" class="deleteRow"><span class="fa fa-trash"></span></a></td>
                                                </tr>
                                            @endforeach
                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Image</label>
                                    <div class="field col-sm-10" align="left">
                                        <input type="file" id="files" name="files[]" multiple />
                                        @if($product->image->count() > 0)
                                        @foreach($product->image as $image)
                                        <span class="pip image-{{$image->id}}"><img class="imageThumb" src="/uploads/product/{{$image->image}}"><br>
                                        <span class="remove" onclick="deleteImage({{$image->id}})">Remove image</span></span>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Image</label>
                                    <div class="field col-sm-4" align="left">
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Publish</option>
                                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Hide</option>
                                        </select>
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

    function deleteImage(param){
        $.ajax({
            type: 'DELETE',
            url: '/imagedelete',
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {id:param,"_token": "{{ csrf_token() }}"},
            success: function (data) {
                $(".image-"+param).remove();
            },
            error: function (data) {
                alert(JSON.stringify(data));
            }
        });
    }
</script>
@endsection

