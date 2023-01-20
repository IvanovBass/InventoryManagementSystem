<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Carbon;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use DB;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    public function InvoiceAll(){
      if(!Auth::check())
      {
          $notification = array(
              'message' => 'Please Log In !',
              'alert-type' => 'error'
          );

          return redirect('/login')->with($notification);
      }
      $user = Auth::user();

      if ($user->admin_profile) {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'asc')->get();
      } else {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'asc')->where('created_by', $user->id)->get();
      }

      return view('backend.invoice.invoice_all', compact('allData'));
    }

    public function invoiceAdd(){
      if(!Auth::check())
      {
          $notification = array(
              'message' => 'Please Log In !',
              'alert-type' => 'error'
          );

          return redirect('/login')->with($notification);
      }

      $product = Product::all();
      $category = Category::all();
      $invoice_data = Invoice::orderBy('id', 'asc')->first();
      $date = date('Y-m-d');
      $user = Auth::user();

      if ($invoice_data == null) {
        $firstReg = '0';
        $invoice_no = $firstReg + 1;
      } else {
        $invoice_data = Invoice::orderBy('id', 'asc')->first()->invoice_no;
        $invoice_no = $user->id.strtotime(date('Y-m-d H:i:s'));
      }

      return view('backend.invoice.invoice_add', compact('invoice_no', 'category', 'product', 'date'));

    }

    public function InvoiceStore(Request $request){
      if(!Auth::check())
      {
          $notification = array(
              'message' => 'Please Log In !',
              'alert-type' => 'error'
          );

          return redirect('/login')->with($notification);
      }

       if ($request->category_id == null) {
        $notification = array(
          'message' => 'You have not selected any items',
          'alert-type' => 'error');
        return redirect()->back()->with($notification);

      }

      if (empty(DB::table('categories')->where('id',$request->category_id)->exists())) {
         $notification = array(
           'message' => 'Selected category cannot be found.',
           'alert-type' => 'error');
         return redirect()->back()->with($notification);

       }

       if (empty(DB::table('products')->where('id',$request->product_id)->exists())) {
         $notification = array(
           'message' => 'Selected product cannot be found.',
           'alert-type' => 'error');
         return redirect()->back()->with($notification);

       }

       foreach ($request->buying_qty as $key => $qty) {
         if (!is_numeric($qty) or $qty < 1) {
          $notification = array(
            'message' => 'Selected quantity is invalid.',
            'alert-type' => 'error');
          return redirect()->back()->with($notification);
        }
       }

       $invoice = new Invoice();
       $invoice->invoice_no = $request->invoice_no;
       $invoice->date = date('Y-m-d',strtotime($request->date));
       $invoice->description = $request->description;
       $invoice->status = '0';
       $invoice->created_by = Auth::user()->id;

       DB::transaction(function() use($request,$invoice){
           if ($invoice->save()) {
            $payment = new Payment();
            $payment_details = new PaymentDetail();
            $payment->invoice_no = $invoice->id;
            $payment->total_amount = 0;

            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category ; $i++) {

               $invoice_details = new InvoiceDetail();
               $invoice_details->date = date('Y-m-d',strtotime($request->date));
               $invoice_details->invoice_no = $invoice->id;
               $invoice_details->category_id = $request->category_id[$i];
               $invoice_details->product_id = $request->product_id[$i];
               $invoice_details->buying_qty = floor($request->buying_qty[$i]);
               $invoice_details->unit_price = Product::where('id',$invoice_details->product_id)->first()->Price;
               $invoice_details->selling_price = $invoice_details->unit_price * $invoice_details->buying_qty;
               $invoice_details->status = '1';
               $invoice_details->save();

               $payment->total_amount += $invoice_details->selling_price;
            }

            $payment->save();

            $payment_details->invoice_no = $invoice->id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->save();
          }

         });


       $notification = array(
        'message' => 'Invoice Data Inserted Successfully',
        'alert-type' => 'success'
      );
      return redirect()->route('invoice.all')->with($notification);
     }

     public function InvoiceDelete($id){
       if(!Auth::check())
       {
           $notification = array(
               'message' => 'Please Log In !',
               'alert-type' => 'error'
           );

           return redirect('/login')->with($notification);
       }

       $invoice = Invoice::findOrFail($id);
       InvoiceDetail::where('invoice_no',$invoice->id)->delete();
       Payment::where('invoice_no',$invoice->id)->delete();
       PaymentDetail::where('invoice_no',$invoice->id)->delete();
       $invoice->delete();
       $notification = array(
         'message' => 'Invoice Deleted Successfully',
         'alert-type' => 'success'
       );
       return redirect()->back()->with($notification);

   }

    public function InvoiceApprove($id){
      if(!Auth::check())
      {
          $notification = array(
              'message' => 'Please Log In !',
              'alert-type' => 'error'
          );

          return redirect('/login')->with($notification);
      }

      $invoice = Invoice::with('invoice_details')->findOrFail($id);
      return view('backend.invoice.invoice_approve', compact('invoice'));
    }

    public function ApprovalStore(Request $request, $id){
        if(!Auth::check())
        {
            $notification = array(
                'message' => 'Please Log In !',
                'alert-type' => 'error'
            );

            return redirect('/login')->with($notification);

        }

        if (!Auth::user()->admin_profile) {
          $notification = array(
              'message' => 'You must an admin to approve this.',
              'alert-type' => 'error'
          );

          return redirect()->back()->with($notification);
        }

        foreach($request->buying_qty as $key => $val){
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();
            if($product->Quantity < $request->buying_qty[$key]){

              $notification = array(
                'message' => 'Too little stock for request.',
                'alert-type' => 'error'
              );
              return redirect()->back()->with($notification);
            }
        }

        $invoice = Invoice::findOrFail($id);
        $invoice->updated_by = Auth::user()->id;
        $invoice->status = '1';

        DB::transaction(function() use($request,$invoice,$id){
          foreach($request->buying_qty as $key => $val){
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();
            $product->Quantity = ((float)$product->Quantity) - ((float)$request->buying_qty[$key]);
            $product->save();
          } // end foreach

          $invoice->save();
        });

        $notification = array(
        'message' => 'Invoice Approve Successfully',
        'alert-type' => 'success'
        );
        return redirect()->route('invoice.all')->with($notification);
      }
}
