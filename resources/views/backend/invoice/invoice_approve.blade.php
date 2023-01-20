@extends('admin.admin_master')
@section('admin')

<div class="page-content">
  <div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Invoice Details</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  @php
    $payment = App\models\Payment::where('invoice_no', $invoice->id)->first();
  @endphp
  <div class="row">
    <div class="col-12">
      <div class="card">
          <div class="card-body">
            <h4>Invoice No: {{ $invoice->invoice_no }}</h4>
            <a href="{{ route('invoice.all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-list"> Invoice List </i></a> <br>  <br>

            <table class="table table-dark" width="100%">
              <tbody>
                <tr>
                  <td colspan="3"><p> Description : <strong> {{ $invoice->description  }} </strong> </p></td>
                </tr>
              </tbody>
            </table>


            @if(!$invoice->status)
            <form method="post" action="{{ route('approval.store',$invoice->id) }}">
            @else
            <form method="get" action="{{ route('invoice.all') }}" >
            @endif

              @csrf
              <table border="1" class="table table-dark" width="100%">
                <thead>
                  <tr>
                    <th class="text-center">Creation Date</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Current Stock</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Unit Price </th>
                    <th class="text-center">Total Price</th>
                  </tr>
                </thead>

                <tbody>
                  @php
                    $total_sum = '0';
                  @endphp
                  @foreach($invoice['invoice_details'] as $key => $details)
                    <tr>
                      <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                      <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                      <input type="hidden" name="buying_qty[{{ $details->id }}]" value="{{ $details->buying_qty }}">

                      <td class="text-center">{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                      <!-- <td class="text-center">{{ $key+1 }}</td> -->
                      <td class="text-center">{{ $details['category']['name'] }}</td>
                      <td class="text-center">{{ $details['product']['Name'] }}</td>
                      <td class="text-center">{{ $details['product']['Quantity'] }}</td>
                      <td class="text-center">{{ $details->buying_qty }}</td>
                      <td class="text-center">{{ $details->unit_price }}</td>
                      <td class="text-center">{{ $details->selling_price }}</td>
                    </tr>
                    @php
                      $total_sum += $details->selling_price;
                    @endphp
                  @endforeach

                  <tr>
                    <td colspan="6"> Total Cost </td>
                    <td >{{ $payment->total_amount }}</td>
                  </tr>
                </tbody>

              </table>
              @if(!$invoice->status)
              <button type="submit" class="btn btn-info"> Approve Invoice  </button>
              @else
              <button href="{{ route('invoice.all') }}" class="btn btn-info"> Invoice already approved! </button>
              @endif
            </form>
          </div>
        </div>
      </div> <!-- end col -->
    </div> <!-- end row -->
  </div> <!-- container-fluid -->
</div>


@endsection
