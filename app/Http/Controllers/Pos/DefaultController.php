<?php
namespace App\Http\Controllers\Pos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
class DefaultController extends Controller
{
     public function GetProduct(Request $request){
       if(!Auth::check())
       {
           $notification = array(
               'message' => 'Please Log In !',
               'alert-type' => 'error'
           );

           return redirect('/login')->with($notification);
       }
        $category_id = $request->category_id;
        if (!ctype_digit($category_id)) {
          $allProduct = Product::all();
        } else {
          $allProduct = Product::where('CategoryID',$category_id)->get();
        }

        return response()->json($allProduct);
    }

    public function GetProductPrice(Request $request){
        if(!Auth::check())
        {
            $notification = array(
                'message' => 'Please Log In !',
                'alert-type' => 'error'
            );

            return redirect('/login')->with($notification);
        }
       $product_id = $request->product_id;
       $allProduct = Product::where('id',$product_id)->get();
       return response()->json($allProduct);
   }

    public function GetStock(Request $request){
      if(!Auth::check())
      {
          $notification = array(
              'message' => 'Please Log In !',
              'alert-type' => 'error'
          );

          return redirect('/login')->with($notification);
      }
        $product_id = $request->product_id;
        $stock = Product::where('id',$product_id)->first()->Quantity;
        return response()->json($stock);

    }

}
