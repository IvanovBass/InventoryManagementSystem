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

                            <h4 class="card-title">Edit Product Page </h4><br><br>


                            @if(count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
                                @endforeach
                            @endif

                            <form method="post" action="{{ route('product.update') }}" id="myForm" >
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Product Name</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Name" class="form-control" type="text" value="{{$product->Name}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Product Description</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Description" class="form-control" type="text" value="{{$product->Description}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="CategoryID">
                                            <option selected ="">Open this select menu</option>

                                            @foreach($category as $cat)
                                                <option value="{{$cat->id}}" {{$cat->id == $product->CategoryID ? 'selected' : ''}}>{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Supplier Name</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="SupplierID">
                                            <option selected ="">Open this select menu</option>

                                            @foreach($supplier as $supp)
                                                <option value="{{$supp->id}}" {{$supp->id == $product->SupplierID ? 'selected' : ''}}>{{$supp->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Price</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Price" class="form-control" type="number" value="{{$product->Price}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Image" class="form-control" type="text" value="{{$product->Image}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Product Reference</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Reference" class="form-control" type="text" value="{{$product->Reference}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Quantity</label>
                                    <div class="form-group col-sm-10">
                                        <input name="Quantity" class="form-control" type="number" value="{{$product->Quantity}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Minimum Quantity</label>
                                    <div class="form-group col-sm-10">
                                        <input name="MinimumQty" class="form-control" type="number" value="{{$product->MinimumQty}}">
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Product">
                            </form>
                        </div>
                    </div>
                </div>
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
                        required : 'Please Enter Supplier Name',
                    },
                    Description: {
                        required : 'Please Enter Supplier Phone Number',
                    },
                    CategoryID: {
                        required : 'Please Enter Supplier Valid Email Address',
                    },
                    SupplierID: {
                        required : 'Please Enter Supplier Valid Email Address',
                    },
                    Price: {
                        required : 'Please Enter Supplier Valid Email Address',
                    },
                    Reference: {
                        required : 'Please Enter Supplier Valid Email Address',
                    },
                    Quantity: {
                        required : 'Please Enter Supplier Valid Email Address',
                    },
                    MinimumQty: {
                        required : 'Please Enter Supplier Valid Email Address',
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
