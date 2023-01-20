@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Inventory</a></li>
                        <li class="breadcrumb-item"><a href="{{route('product.list')}}">Products</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Product Page </h4><br><br>

                            @if(count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
                                @endforeach
                            @endif

                            <form method="post" action="{{ route('product.store') }}" id="myForm" >
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Product Name</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Name" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Product Description</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Description" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="CategoryID">

                                            @foreach($category as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Supplier Name</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="SupplierID">

                                            @foreach($supplier as $supp)
                                                <option value="{{$supp->id}}">{{$supp->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Price</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Price" class="form-control" type="number">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Image" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Product Reference</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Reference" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Quantity</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Quantity" class="form-control" type="number">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Minimum Quantity</label>
                                    <div class="form-group col-sm-10">
                                        <input name="MinimumQty" class="form-control" type="number">
                                    </div>
                                </div>


                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#myForm').validate({
                rules: {
                    Name: {
                        required : true,
                    },
                    Description: {
                        required : true,
                    },
                    CategoryID: {
                        required : true,
                    },
                    SupplierID: {
                        required : true,
                    },
                    Price: {
                        required : true,
                    },
                    Image: {
                        required : false,
                    },
                    Reference: {
                        required : true,
                    },
                    Quantity: {
                        required : true,
                    },
                    MinimumQty: {
                        required : true,
                    },
                },
                messages:{
                    Name: {
                        required : 'Please Enter Product Name',
                    },
                    Description: {
                        required : 'Please Enter Product Description',
                    },
                    CategoryID: {
                        required : 'Please Enter Product Valid Category',
                    },
                    SupplierID: {
                        required : 'Please Enter Product Valid Supplier',
                    },
                    Price: {
                        required : 'Please Enter Product Valid Price',
                    },
                    Image: {
                        required : 'Please Enter Product Valid Image',
                    },
                    Reference: {
                        required : 'Please Enter Product Valid Reference',
                    },
                    Quantity: {
                        required : 'Please Enter Product Valid Quantity',
                    },
                    MinimumQty: {
                        required : 'Please Enter Product Valid MinimumQty',
                    },
                },
                errorElement : 'span',
                errorPlacement: function(error,element){
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

@endsection
