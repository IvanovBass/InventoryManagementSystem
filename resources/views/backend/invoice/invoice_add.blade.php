@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">

<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Add Invoice  </h4><br><br>


    <div class="row">

         <div class="col-md-2">
            <div class="md-1">
                <label for="example-text-input" class="form-label">Inv No</label>
                 <input class="form-control example-date-input" name="invoice_no" type="text" value="{{ $invoice_no }}"  id="invoice_no" readonly style="background-color:#ddd" >
            </div>
        </div>


        <div class="col-md-2">
            <div class="md-3">
                <label for="example-text-input" class="form-label">Date</label>
                 <input class="form-control example-date-input" value="{{ $date }}" name="date" type="date"  id="date">
            </div>
        </div>

       <div class="col-md-2">
            <div class="md-3">
                <label for="example-text-input" class="form-label">Category Name </label>
                <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                  <option selected="">All Categories</option>
                  @foreach($category as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                  @endforeach
                </select>
            </div>
        </div>


         <div class="col-md-3">
            <div class="md-3">
                <label for="example-text-input" class="form-label">Product Name </label>
                <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                  <option selected="">Select Product</option>
                  @foreach($product as $pro)
                    <option value="{{ $pro->id }}">{{ $pro->Name }}</option>
                  @endforeach
                </select>
            </div>
        </div>


        <div class="col-md-1">
           <div class="md-3">
               <label for="example-text-input" class="form-label">Stock(Pic/Kg)</label>
                <input class="form-control example-date-input" name="current_stock_qty" type="text"  id="current_stock_qty" readonly style="background-color:#ddd" >
           </div>
        </div>


<div class="col-md-2">
    <div class="md-3">
        <label for="example-text-input" class="form-label" style="margin-top:43px;">  </label>


        <i class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> Add More</i>
    </div>
</div>





    </div> <!-- // end row  -->

        </div> <!-- End card-body -->

        <div class="card-body">
        <form method="post" action="{{ route('invoice.store') }}">
            @csrf
            <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Product Name </th>
                        <th width="7%">PSC/KG</th>
                        <th width="10%">Unit Price </th>
                        <th hidden id="temp_price"></th>
                        <th width="15%">Total Price</th>
                        <th width="7%">Action</th>
                    </tr>
                </thead>

                <tbody id="addRow" class="addRow">

                </tbody>

                <tbody>


                    <tr>
                        <td colspan="4">Grand Total</td>
                        <td>
                            <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                        </td>
                        <td></td>
                    </tr>

                </tbody>
            </table><br>

            <div class="form-row">
                <div class="form-group col-md-12">
                  <textarea name="description" class="form-control" id="description" placeholder="Invoice Description"></textarea>
                </div>
            </div><br>

            <div class="form-group">
                <button type="submit" class="btn btn-info" id="storeButton"> Invoice Store</button>

            </div>

        </form>
        </div> <!-- End card-body -->
    </div>
</div> <!-- end col -->
</div>

</div>
</div>

<script id="document-template" type="text/x-handlebars-template">

  <tr class="delete_add_more_item" id="delete_add_more_item">
          <input type="hidden" name="date" value="@{{date}}">
          <input type="hidden" name="invoice_no" value="@{{invoice_no}}">

      <td>
          <input type="hidden" name="category_id[]" value="@{{category_id}}">
          @{{ category_name }}
      </td>

       <td>
          <input type="hidden" name="product_id[]" value="@{{product_id}}">
          @{{ product_name }}
      </td>

       <td>
          <input type="number" min="1" class="form-control buying_qty text-right" name="buying_qty[]" value="">
      </td>

      <td>
          <input type="number" class="form-control unit_price text-right" name="unit_price[]" value="@{{unit_price}}" readonly>
      </td>

       <td>
          <input type="number" class="form-control selling_price text-right" name="selling_price[]" value="0" readonly>
      </td>

       <td>
          <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
      </td>

    </tr>

</script>


<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click",".addeventmore", function(){
            var date = $('#date').val();
            var invoice_no = $('#invoice_no').val();
            var category_id  = $('#category_id').val();
            var category_name = $('#category_id').find('option:selected').text();
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').find('option:selected').text();
            var unit_price = $('#temp_price').html();

            if(date == ''){
                $.notify("Date is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
            }

            if(isNaN(category_id)){

                $.notify("Category is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
            }

            if(product_id == ''){
                $.notify("Product Field is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
            }

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
              date:date,
              invoice_no:invoice_no,
              category_id:category_id,
              category_name:category_name,
              product_id:product_id,
              product_name:product_name,
              unit_price:unit_price
            };
            var html = template(data);
            $("#addRow").append(html);
        });

        $(document).on("click",".removeeventmore",function(event){
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice();
        });

        $(document).on('keyup click','.buying_qty', function(){
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var qty = $(this).closest("tr").find("input.buying_qty").val();
            var total = unit_price * qty;
            $(this).closest("tr").find("input.selling_price").val(total);

            totalAmountPrice()
        });

        // Calculate sum of amout in invoice
        function totalAmountPrice(){
            var sum = 0;
            $(".selling_price").each(function(){
                var value = $(this).val();
                if(!isNaN(value) && value.length != 0){
                    sum += parseFloat(value);
                }
            });

            $('#estimated_amount').val(sum);
        }

    });
</script>


<script type="text/javascript">
    $(function(){
        $(document).on('change','#category_id',function(){
            var category_id = $(this).val();
            console.log(category_id);
            $.ajax({
                url:"{{ Route('get-product') }}",
                type: "GET",
                data:{category_id:category_id},
                success:function(data){
                    var html = '<option value="">Select Product</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.id+' "> '+v.Name+'</option>';
                    });
                    $('#product_id').html(html);
                    $('#current_stock_qty').val('');
                }
            });
        });
    });
</script>

<script type="text/javascript">
   $(function(){
       $(document).on('change','#product_id',function(){
           var product_id = $(this).val();

           $.ajax({
               url:"{{ route('check-product-stock') }}",
               type: "GET",
               data:{product_id:product_id},
               success:function(data){
                   $('#current_stock_qty').val(data);
               }
           });

           $.ajax({
               url:"{{ route('get-price') }}",
               type: "GET",
               data:{product_id:product_id},
               success:function(data){
                 var unit_price = data[0].Price;
                  $('#temp_price').html(unit_price);
                  $('#category_id').val(data[0].CategoryID);
               }
           });

       });
   });
</script>

@endsection
