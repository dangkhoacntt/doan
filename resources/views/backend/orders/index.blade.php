<!-- resources/views/admin/orders/index.blade.php -->
@extends('backend.master')	
@section('title','oders')
@section('main')
    <div class="container">
        <h2>Quản lý Đơn hàng</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Người đặt hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">Xem chi tiết</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')">Xóa</button>
                        </form>
                        @if($order->status !== 'đã xác nhận')
    <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST" style="display: inline-block">
        @csrf
        <button type="submit" class="btn btn-success">Xác nhận</button>
    </form>
@endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
