<?php

namespace App\Http\Controllers;
use App\Models\Baner;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Comment;
class FrontendController extends Controller
{
    //

        public function index()
        {
            $baners = Baner::all();
            return view('frontend.master', compact('baners'));
        }
    public function gethome(){
        $data['featured'] = Product::where('prod_featured',1)->orderBy('prod_id','desc')->take(8)->get();
        $data['news'] = Product::orderBy('prod_id','desc')->take(8)->get();
        $data['banners'] = Baner::all();
        return view('frontend.home',$data);

    }
    public function getsingle(){
        return view('frontend.singlemenu',$data);

    }
    public function getDetail($id){
        $data['item'] = Product::find($id);
        $data['comments'] = Comment::where('com_product',$id)->get();
        $data['banners'] = Baner::all();
        $data['quantity'] = $data['item']->prod_quantity;
        return view('frontend.details', $data);
    }
    public function getCategory($id){
        $data['cateName'] = Category::find($id);
        $data['items'] = Product::where('prod_cate',$id)->orderBy('prod_id','desc')->paginate(8);
        $data['banners'] = Baner::all();
        return view('frontend.category', $data);
    }
    public function postComment(Request $request,$id){
        $data['banners'] = Baner::all();
        $comment = new Comment;
        $comment->com_name = $request->name;
        $comment->com_email = $request->email;
        $comment->com_content = $request->content;
        $comment->com_product = $id;
        $comment->save();
        return back();
    }
    public function getSearch(Request $request)
{
    $data['banners'] = Baner::all();
    $keyword = $request->result;
    $data['keyword'] = $keyword;

    // Lấy giá trị tối thiểu và tối đa từ request
    $minPrice = $request->min_price;
    $maxPrice = $request->max_price;

    // Tạo truy vấn ban đầu với điều kiện tìm kiếm theo tên sản phẩm
    $query = Product::query()->where('prod_name', 'like', '%' . $keyword . '%');

    // Thêm điều kiện lọc theo giá nếu có
    if ($minPrice !== null) {
        $query->where('prod_price', '>=', $minPrice);
    }

    if ($maxPrice !== null) {
        $query->where('prod_price', '<=', $maxPrice);
    }

    // Thực hiện truy vấn và lấy danh sách sản phẩm
    $data['items'] = $query->get();

    return view('frontend.search', $data);
}

}
