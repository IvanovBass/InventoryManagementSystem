@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                        </div>
                        <h4 class="card-title mb-4" >Product List</h4>

                        <div class="table-responsive">
                          <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width:100%;">
                                <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Reference</th>
                                    <th>Quantity</th>
                                    <th>Minimum Quantity</th>
                                </tr>
                                </thead>
                                <tbody id="product_list">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.onload = function() {
    $.ajax(
    {
      url:"{{ route('product.admin') }}",
      type: "GET",
      success:function(data){
        html = "";
        i = 0;
        for (var i = 0; i < data.length; i++) {
          // Start Row
          html += "<tr ";
          // If low stock add red style
          if (parseInt(data[i].Quantity) < parseInt(data[i].MinimumQty)) {
            html += 'style="background-color:#FFC300; font-weight:bold; color:black"'
          }
          // Close row, add items
          html += ("><td>" + data[i].Name + "</td><td>" + data[i].Price + "</td><td>" + data[i].Reference + "</td><td>" + data[i].Quantity + "</td><td>" + data[i].MinimumQty + "</td></tr>");
        }
        $('#product_list').html(html);
      }
    });
};
</script>
@endsection
