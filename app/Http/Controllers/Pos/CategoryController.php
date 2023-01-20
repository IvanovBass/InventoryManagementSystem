<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
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

    public function CategoryList()
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $category =  Category::latest()->get();

        if($category)
        {
            return view('backend.category.category_list', compact('category'));
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

    public function CategoryAdd()
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        return view('backend.category.category_add');
    }

    public function CategoryStore(Request $request)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }


        if(DB::table('categories')->where('name',$request->name)->exists())
        {
            $notification = array(
                'message' => 'This Category Already Exists!',
                'alert-type' => 'error'
            );

            return redirect()->route('category.list')->with($notification);
        }

        $execute = Category::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now()

        ]);

        if($execute)
        {
            $notification = array(
                'message' => 'Category Added Successfully',
                'alert-type' => 'success'
            );
        }
        else
        {
            $notification = array(
                'message' => 'Category Has Not Been Added',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('category.list')->with($notification);
    }

    public function CategoryEdit($id)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $category = Category::findOrFail($id);

        if($category)
        {
            return view('backend.category.category_edit',compact('category'));
        }
        else
        {
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert-type' => 'error'
            );

            return redirect()->route('category.list')->with($notification);
        }
    }

    public function CategoryUpdate(Request $request)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }

        $category_id = $request->id;

        if (empty(DB::table('categories')->where('id',$request->id)->exists())) {
          $notification = array(
              'message' => 'ID not found',
              'alert-type' => 'error'
          );

          return redirect()->back()->with($notification);
        }

        if(DB::table('categories')->where('name',$request->name)->exists())
        {
            $notification = array(
                'message' => 'This Category Already Exists!',
                'alert-type' => 'error'
            );

            return redirect()->route('category.list')->with($notification);
        }

        $execute = Category::findOrFail($category_id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()

        ]);

        if($execute)
        {
            $notification = array(
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            );
        }
        else
        {
            $notification = array(
                'message' => 'Category Has Not Been Updated',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('category.list')->with($notification);
    }

    public function CategoryDelete($id)
    {
        if(!$this->AuthCheck())
        {
            $notification = array(
                'message' => 'Please Log In As Administrator!',
                'alert-type' => 'error'
            );

            return redirect('/dashboard')->with($notification);
        }
        if(DB::table('products')->where('CategoryID',$id)->exists())
        {
            $notification = array(
                'message' => 'Delete Impossible, Products Linked !',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $execute = Category::findOrFail($id)->delete();

        if($execute)
        {
            $notification = array(
                'message' => 'Category Deleted Successfully',
                'alert-type' => 'success'
            );
        }
        else
        {
            $notification = array(
                'message' => 'Category Has Not Been Deleted',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('category.list')->with($notification);
    }
}
