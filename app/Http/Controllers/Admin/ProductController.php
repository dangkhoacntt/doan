<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;
use DB;
class ProductController extends Controller
{
  public function getProduct(){
    $data['productlist'] = DB::table('vp_products')->join('vp_categories','vp_products.prod_cate','=','vp_categories.cate_id')->orderBy('prod_id','desc')->get();
    return view('backend.product',$data);
  }
  public function getAddProduct(){
    $data['catelist'] = Category::all();
    return view('backend.addproduct',$data);
  }
  public function postAddProduct(AddProductRequest $request){
     $filename = $request->img->getClientOriginalName();
    $product = new Product;
    $product->prod_name = $request->name;
    $product->prod_slug = Str::slug($request->name);
    $product->prod_img = $filename;
    $product-> prod_accessories = $request->accessories;
    $product-> prod_price = $request->price;
    $product-> prod_warranty = $request->warranty;
    $product-> prod_promotion = $request->promotion;
    $product-> prod_condition = $request->condition;
    $product-> prod_status = $request->status;
    $product-> prod_description = $request->description;
    $product-> prod_cate = $request->cate;
    $product-> prod_featured = $request->featured;
    $product-> save();
    $request->img->storeAs('public',$filename);
    return back();
  }
  public function getEditProduct($id){
    $data ['product'] = Product::find($id);
    $data ['listcate'] = Category::all();
    return view('backend.editproduct',$data);
  }
  public function postEditProduct(Request $request, $id)
{
    // Tìm sản phẩm cần chỉnh sửa
    $product = Product::find($id);

    // Cập nhật thông tin sản phẩm từ dữ liệu nhập từ form
    $product->prod_name = $request->name;
    $product->prod_slug = Str::slug($request->name);
    $product->prod_price = $request->price;
    $product->prod_accessories = $request->accessories;
    $product->prod_promotion = $request->promotion;
    $product->prod_warranty = $request->warranty;
    $product->prod_condition = $request->condition;
    $product->prod_status = $request->status;
    $product->prod_description = $request->description;
    $product->prod_cate = $request->cate;
    $product->prod_featured = $request->featured;
    
    // Kiểm tra nếu có file ảnh được tải lên từ form
    if ($request->hasFile('img')) {
        $img = $request->img->getClientOriginalName();
        $product->prod_img = $img;
        $request->img->storeAs('public', $img);
    }
    
    // Cập nhật số lượng sản phẩm
    $product->prod_quantity = $request->quantity;

    // Lưu các thay đổi vào cơ sở dữ liệu
    $product->save();

    return redirect('admin/product');
}
public function getDeleteProduct($id){
  Product::destroy($id);
  return back();
}
}
