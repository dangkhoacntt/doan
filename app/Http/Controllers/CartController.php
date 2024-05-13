<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart;
use App\Models\Baner;
use App\Models\Product;
use App\Models\Order;
use Mail;
class CartController extends Controller
{
    public function getAddCart($id){
       
       $product = Product::find($id);
       Cart::add(['id' =>  $id , 'name' => $product->prod_name, 'qty' => 1, 'price' => $product->prod_price, 'options' => ['img' =>$product->prod_img]]);
        return redirect('cart/show');
    }
    public function getShowCart(){
       
        $data['total'] = Cart::total();
        $data['items'] = Cart::content();
        $data['banners'] = Baner::all();
        return view('frontend.cart',$data);
       
    }
    public function getDeleteCart($id){
        $data['banners'] = Baner::all();
        if($id=='all'){
        Cart::destroy();
    }else{
      Cart::remove($id);  
    }
    return back();
    }
    public function  getUpdateCart(Request $request){
        $data['banners'] = Baner::all();
        Cart::update($request->rowId,$request->qty);
    }
    public function postComplete(Request $request){
        $data['banners'] = Baner::all();
        $data['infor'] = $request->all();
        $email = $request->email;
        $data['total'] = Cart::total(); 
        $data['cart'] = Cart::content();
        // Mail::send('frontend.email', $data, function ($message) use($email) {
        //     $message->from('tuyetnhi040101@gmail.com', 'dang khoa');
        //     $message->to($email, $email);
        //     $message->cc('cubom882001@gmail.com', 'John Doe');
        //     $message->subject('xac nhan mua hang');
        // });
        return redirect('complete');
    }
    public function getComplete(){
        $data['banners'] = Baner::all();
        return view('frontend.complete');
    }
}
