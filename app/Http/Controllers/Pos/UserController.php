<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;

class UserController extends Controller
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

    public function UserList()
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

          $user =  User::latest()->get();

          if($user)
          {
              return view('backend.user.user_list', compact('user'));
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

    public function UserAdd()
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        return view('backend.user.user_add');
    }

    public function UserStore(Request $request)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

          if(preg_match('/^(?=.*\d)(?=.*[.*@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z.*@#\-_$%^&+=§!\?]{10,30}$/',
          $request->password))  {

            if ($request->file('profile_image')){
                $file = $request->file('profile_image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
            } else {
                $filename = "";
            };

            $execute = User::insert([
                'name' => $request->name,
                'admin_profile' => $request->admin_profile,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'profile_image' => $filename

            ]);

            if($execute)
            {
                $notification = array(
                    'message' => 'User Added Successfully',
                    'alert-type' => 'success'
                );
            }
            else
            {
                $notification = array(
                    'message' => 'User Has Not Been Added',
                    'alert-type' => 'error'
                );
            }

          }
          else
          {
              $notification = array(
                  'message' => 'Invalid password',
                  'alert-type' => 'error'
              );

              return redirect()->route('user.add')->with($notification);
          }

          return redirect()->route('user.list')->with($notification);
    }


    public function UserEdit($id)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $user = User::findOrFail($id);

        if($user)
        {
            return view('backend.user.user_edit',compact('user'));
        }
        else
        {
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert-type' => 'error'
            );

            return redirect()->route('user.list')->with($notification);
        }
    }

    public function UserUpdate(Request $request)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

          $user_id = $request->id;

          if(empty(DB::table('users')->where('id',$request->id)->exists()))
          {
              $notification = array(
                  'message' => 'User ID not found.',
                  'alert-type' => 'error'
              );

              return redirect()->back()->with($notification);
          }

            if ($request->file('profile_image')){
                $file = $request->file('profile_image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
            }
            else {
                $filename = (User::find($user_id))->profile_image;
            };

            $request->profile_image = $filename;

            $execute = User::findOrFail($user_id)->update([
                'name' => $request->name,
                'admin_profile' => $request->admin_profile,
                'email' => $request->email,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
                'profile_image' => $request->profile_image,

            ]);

            if($execute)
            {
                $notification = array(
                    'message' => 'User Updated Successfully',
                    'alert-type' => 'success'
                );
            }
            else
            {
                $notification = array(
                    'message' => 'User Has Not Been Updated',
                    'alert-type' => 'error'
                );
            }

          return redirect()->route('user.list')->with($notification);
    }

    public function UserDelete($id)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        while (DB::table('invoices')->where('created_by', $id)->exists()) {
          $invoice = Invoice::where('created_by', $id)->first();
          InvoiceDetail::where('invoice_no',$invoice->id)->delete();
          Payment::where('invoice_no',$invoice->id)->delete();
          PaymentDetail::where('invoice_no',$invoice->id)->delete();
          $invoice->delete();
        }

        $execute = User::findOrFail($id)->delete();
        if ($execute)
        {
            $notification = array(
                'message' => 'User Deleted Successfully',
                'alert-type' => 'success'
            );
        } else
        {
            $notification = array(
                'message' => 'User Has Not Been Deleted',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('user.list')->with($notification);
    }
}
