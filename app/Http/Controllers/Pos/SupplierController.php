<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function AuthCheck()
    {
        if(!auth::check())
        {
            return false;
        }

        if(!Auth::user()->admin_profile)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function SuppliersList()
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        //$suppliers = Supplier::all();
        $suppliers = Supplier::latest()->get();

        if($suppliers)
        {
            return view('backend.supplier.supplier_list', compact('suppliers'));
        }
        else
        {
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert-type' => 'error'
            );

            return redirect()->route('dashboard')->with($notification);
        }
    }

    public function SupplierAdd()
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        return view('backend.supplier.supplier_add');
    }

    public function SupplierStore(Request $request)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $phone = $request->phone;

        if(!is_numeric($request->phone))
        {
            $notification = array(
                'message' => 'This Is Not A Valid Phone Number !',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if(filter_var($request->email, FILTER_VALIDATE_EMAIL))
        {
            $execute = Supplier::insert([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);
        }
        else
        {
            $execute = false;
        }

        if($execute)
        {
            $notification = array(
                'message' => 'Supplier Added Successfully',
                'alert-type' => 'success'
            );
        }
        else
        {
            $notification = array(
                'message' => 'Supplier Has Not Been Added',
                'alert-type' => 'error'
            );
        }

        //redirect to login page after logout
        return redirect()->route('suppliers.list')->with($notification);
    }

    public function SupplierEdit($id)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $supplier = Supplier::findOrFail($id);

        if($supplier)
        {
            return view('backend.supplier.supplier_edit',compact('supplier'));
        }
        else
        {
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard')->with($notification);
        }
    }

    public function SupplierUpdate(Request $request)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $supplier_id = $request->id;

        if (empty(DB::table('suppliers')->where('id',$request->id)->exists())) {
          $notification = array(
              'message' => 'ID not found',
              'alert-type' => 'error'
          );

          return redirect()->back()->with($notification);
        }

        if(!is_numeric($request->phone))
        {
            $notification = array(
                'message' => 'This Is Not A Valid Phone Number !',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if(filter_var($request->email, FILTER_VALIDATE_EMAIL))
        {
            $execute = Supplier::findOrFail($supplier_id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now()
            ]);
        }
        else
        {
            $execute = false;
        }

        if($execute)
        {
            $notification = array(
                'message' => 'Supplier Updated Successfully',
                'alert-type' => 'success'
            );
        }
        else
        {
            $notification = array(
                'message' => 'Supplier Has Not Been Updated',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('suppliers.list')->with($notification);
    }

    public function SupplierDelete($id)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        if(DB::table('products')->where('SupplierID',$id)->exists())
        {
            $notification = array(
                'message' => 'Delete Impossible, Products Linked !',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        $execute = Supplier::findOrFail($id)->delete();

        if($execute)
        {
            $notification = array(
                'message' => 'Supplier Deleted Successfully',
                'alert-type' => 'success'
            );
        }
        else
        {
            $notification = array(
                'message' => 'Supplier Has Not Been Deleted',
                'alert-type' => 'error'
            );
        }

        //redirect to login page after logout
        return redirect()->route('suppliers.list')->with($notification);
    }

}
