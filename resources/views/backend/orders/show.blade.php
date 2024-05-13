<!-- resources/views/admin/orders/show.blade.php -->
@extends('backend.master') 
@section('title', 'Chi tiết đơn hàng')
@section('main')
    <div class="container">
        <h2>Chi tiết Đơn hàng #{{ $order->id }}</h2>
        <table class="table">
            <tr>
                <th>Người đặt hàng:</th>
                <td>{{ $order->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <th>Số điện thoại:</th>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <th>Địa chỉ:</th>
                <td>{{ $order->address }}</td>
            </tr>
            <!-- Thêm các thông tin khác của đơn hàng nếu cần -->
        </table>
        <h3>Chi tiết đơn hàng:</h3>
        <table class="table">
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->quantity * $item->price }}</td>
            </tr>
            @endforeach
        </table>
        @if($order->status !== 'đã xác nhận')
        <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Xác nhận đơn hàng</button>
        </form>
        @endif
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Quay lại</a>
    </div>
@endsection
