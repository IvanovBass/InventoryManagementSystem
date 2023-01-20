@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Pending Invoice</h4>



                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('invoice.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Add Invoice </i></a> <br>  <br>

                    <h4 class="card-title">Pending Invoice Data </h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Date </th>
                            <th>Requestor </th>
                            <th>Description</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>


                        <tbody>

                        	@foreach($allData as $key => $item)

                          <tr>
                              <td> #{{ $item->invoice_no }} </td>
                              <td> {{ date('d-m-Y',strtotime($item->date))  }} </td>
                              <td> {{ $item['user']['name'] }} </td>
                              <td> {{ $item->description }} </td>
                              <td> @if (!empty($item['payment']['total_amount'])) $ {{ $item['payment']['total_amount'] }} @endif</td>
                              <td> @if(!$item->status)
                                  <span class="btn btn-warning">Pending</span>
                                  @else
                                  <span class="btn btn-success">Approved</span>
                                  @endif
                              </td>

                              <td>

                                  <a href="{{ route('invoice.approve',$item->id) }}" class="btn btn-dark sm" title="Approve or check Data">  <i class="fas fa-check-circle"></i> </a>
                                  @if(!$item->status)
                                  <a href="{{ route('invoice.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
                                  @endif
                              </td>
                          </tr>
                        @endforeach

                        </tbody>
                    </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                    </div> <!-- container-fluid -->
                </div>


@endsection
