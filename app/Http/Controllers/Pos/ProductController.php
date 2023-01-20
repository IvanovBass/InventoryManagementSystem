<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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

    public function ProductAll()
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $product =  Product::latest()->get();
        if($product)
        {
            return view('backend.product.product_list', compact('product'));
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

    public function AdminList()
    {
        $product =  Product::latest()->get();
        return $product;
    }

    public function ProductAdd()
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $supplier = Supplier::all();
        $category = Category::all();

        if($supplier && $category)
        {
            return view('backend.product.product_add', compact('supplier','category'));
        }
        else
        {
            $notification = array(
                'message' => 'Product Has Not Been Added',
                'alert-type' => 'error'
            );

            return redirect()->route('product.list')->with($notification);
        }

    }

    public function ProductStore(Request $request)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        if(!is_numeric($request->Quantity) || !is_numeric($request->MinimumQty) || !is_numeric($request->Price))
        {
            $notification = array(
                'message' => 'This Is Not A Valid Number !',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $execute = Product::insert([
            'Name' => $request->Name,
            'Description' => $request->Description,
            'CategoryID' => $request->CategoryID,
            'SupplierID' => $request->SupplierID,
            'Price' => $request->Price,
            'Image' => $request->Image,
            'Reference' => $request->Reference,
            'Quantity' => $request->Quantity,
            'MinimumQty' => $request->MinimumQty,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        if($execute)
        {
            $notification = array(
                'message' => 'Product Added Successfully',
                'alert-type' => 'success'
            );
        }
        else
        {
            $notification = array(
                'message' => 'Product Has Not Been Added',
                'alert-type' => 'error'
            );
        }


        return redirect()->route('product.list')->with($notification);
    }

    public function ProductEdit($id)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $supplier = Supplier::all();
        $category = Category::all();
        $product = Product::findOrFail($id);

        if($product && $category && $supplier)
        {
            return view('backend.product.product_edit', compact('product','supplier','category'));
        }
        else
        {
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert-type' => 'error'
            );

            return redirect()->route('product.list')->with($notification);
        }
    }

    public function ProductUpdate(Request $request)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $product_id = $request->id;

        if(empty(DB::table('products')->where('id',$request->id)->exists()))
        {
            $notification = array(
                'message' => 'Product ID not found.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if(empty(DB::table('categories')->where('id',$request->CategoryID)->exists()))
        {
            $notification = array(
                'message' => 'Category ID not found.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if(empty(DB::table('suppliers')->where('id',$request->SupplierID)->exists()))
        {
            $notification = array(
                'message' => 'Supplier ID not found.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if(!is_numeric($request->Quantity) || !is_numeric($request->MinimumQty) || !is_numeric($request->Price))
        {
            $notification = array(
                'message' => 'This Is Not A Valid Number !',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $execute = Product::findOrFail($product_id)->update([
            'Name' => $request->Name,
            'Description' => $request->Description,
            'CategoryID' => $request->CategoryID,
            'SupplierID' => $request->SupplierID,
            'Price' => $request->Price,
            'Image' => $request->Image,
            'Reference' => $request->Reference,
            'Quantity' => $request->Quantity,
            'MinimumQty' => $request->MinimumQty,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        if($execute)
        {
            $notification = array(
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
            );
        }
        else
        {
            $notification = array(
                'message' => 'Product Has Not Been Updated',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('product.list')->with($notification);
    }

    public function ProductDelete($id)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        if (DB::table('invoice_details')->where('product_id', $id)->exists()) {
          $notification = array(
              'message' => 'Product ID is linked to invoice(s)',
              'alert-type' => 'error'
          );
          return redirect()->route('product.list')->with($notification);
        }

        $execute = Product::findOrFail($id)->delete();

        if($execute)
        {
            $notification = array(
                'message' => 'Product Deleted Successfully',
                'alert-type' => 'success'
            );
        }
        else
        {
            $notification = array(
                'message' => 'Product Has Not Been Updated',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function ProductWithdrawList()
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $execute = $product = Product::latest()->get();

        if(!$execute)
        {
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert-type' => 'error'
            );
            return redirect()->route('product.list')->with($notification);
        }

        return view('backend.product.product_withdrawList', compact('product'));
    }

    public function ProductWithdraw($id)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $execute = $product = Product::findOrFail($id);

        if(!$execute)
        {
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert-type' => 'error'
            );

            return view('backend.product.product_withdrawList', compact('product'))->with($notification);
        }

        return view('backend.product.product_withdraw', compact('product'));
    }

    public function ProductWithdrawId(Request $request)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $product_id = $request->id;

        if(empty(DB::table('products')->where('id',$request->id)->exists()))
        {
            $notification = array(
                'message' => 'Product ID not found.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if(!is_numeric($request->quantity) || !is_numeric($request->WithdrawQty))
        {
            $notification = array(
                'message' => 'This Is Not A Valid Number !',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        $quantity = (int)$request->quantity;
        $withdrawQty = (int)$request->WithdrawQty;
        $quantity = $quantity+abs($withdrawQty);

        $execute = Product::findOrFail($product_id)->update([
            'Quantity' => $quantity
        ]);

        if($execute)
        {
            $notification = array(
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
            );
        }
        else
        {
            $notification = array(
                'message' => 'Product Has Not Been Updated',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('product.withdrawList')->with($notification);
    }
}
