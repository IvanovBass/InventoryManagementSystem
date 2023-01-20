@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Replenish</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Inventory</a></li>
                                <li class="breadcrumb-item active">Replenish</li>
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

                                </a>
                            </div>

                            <h4 class="card-title mb-4" >Product Replenish List</h4>

                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width:100%;">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Price</th>
                                        <th>Reference</th>
                                        <th>Quantity</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($product as $key => $item)

                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->Name}}</td>
                                            <td>{{$item ['category']['name']}}</td>
                                            <td>{{$item ['supplier']['name']}}</td>
                                            <td>{{$item->Price}}</td>
                                            <td>{{$item->Reference}}</td>
                                            <td>{{$item->Quantity}}</td>
                                            <td><a href="{{route ('product.withdraw', $item->id)}}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a></td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
