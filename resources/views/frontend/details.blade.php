
	<link rel="stylesheet" href="css/details.css">
@extends('frontend.master')
@section('title','chi tiet san pham')
@section('main')
					<div id="wrap-inner">
						<div id="product-info">
							<div class="clearfix"></div>
							<h3> {{$item->prod_name}} </h3>
							<div class="row">
								<div id="product-img" class="col-xs-12 col-sm-12 col-md-3 text-center">
									<img width="200px" src="{{asset('storage/'.$item->prod_img)}}">
								</div>
								<div id="product-details" class="col-xs-12 col-sm-12 col-md-9">
									<p>Giá: <span class="price">{{ number_format($item->prod_price,0,',','.')}}</span></p>
									<p>Bảo hành: {{$item->prod_warranty}}</p> 
									<p>Phụ kiện: {{$item->prod_accessories}}</p>
									<p>Số lượng: {{$item->prod_quantity}}</p> 
									<p>Tình trạng: {{$item->prod_condition}}</p>
									<p>Khuyến mại: {{$item->prod_promotion}}</p>
									<p>Còn hàng: @if($item->prod_status==1) con hang @else het hang @endif</p>

									@if($item->prod_quantity == 0)
    <p class="text-danger">Sản phẩm hiện đang hết hàng</p>
@else
    <!-- Hiển thị nút đặt hàng -->
    <p class="add-cart text-center">
    @if(Auth::check())   
        <a href="{{asset('cart/add/'.$item->prod_id)}}">Đặt hàng online</a>
    @else
        <span>Vui lòng đăng nhập để đặt hàng online</span>
    @endif
    </p>
@endif
								</div>
							</div>							
						</div>
						<div id="product-detail">
							<h3>Chi tiết sản phẩm</h3>
							<p class="text-justify">{{$item->prod_description}}</p>
						</div>
						<div id="comment">
    <h3>Bình luận</h3>
    @if(Auth::check())
        <div class="col-md-9 comment">
            <form method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input required type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group">
                    <label for="name">Tên:</label>
                    <input required type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                </div>
                <div class="form-group">
                    <label for="cm">Bình luận:</label>
                    <textarea required rows="10" id="cm" class="form-control" name="content"></textarea>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-default">Gửi</button>
                </div>
            </form>
        </div>
    @else
        <p>Vui lòng đăng nhập để bình luận</p>
    @endif
</div>

						<div id="comment-list">
							@foreach ($comments as $comment )
								
							
							<ul>
								<li class="com-title">
									{{$comment->com_name}}
									<br>
									<span>{{date('d/m/Y H:i',strtotime($comment->created_at))}}</span>	
								</li>
								<li class="com-details">
									{{$comment->com_content}}
								</li>
							
							</ul>
							@endforeach
						</div>
					</div>		
					@stop			