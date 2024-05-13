<?php

namespace App\Http\Controllers\Admin;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function showOrderDetails($orderId)
{
    $order = Order::findOrFail($orderId);
    $items = OrderDetail::where('order_id', $orderId)->get();
    return view('backend.orders.show', compact('order', 'items'));
}

    public function confirmOrder(Request $request)
{

    // Lấy các mục từ giỏ hàng từ request
    $items = $request->input('items');
    
    // Lưu thông tin đơn hàng
    $order = new Order();
    $order->email = $request->input('email');
    $order->name = $request->input('name');
    $order->phone = $request->input('phone');
    $order->address = $request->input('address');
    $order->save();
    
    // Lưu thông tin chi tiết đơn hàng
    foreach ($items as $item) {
        $orderDetail = new OrderDetail();
        $orderDetail->order_id = $orderId; // Gán ID của đơn hàng đã tạo trước đó
        $orderDetail->product_name = $item->name;
        $orderDetail->quantity = $item->qty;
        $orderDetail->price = $item->price;
        $orderDetail->save();
    }

    // Xóa giỏ hàng sau khi đã xác nhận đơn hàng
    Cart::destroy();

    // Chuyển hướng đến trang thông báo thành công
    return redirect()->route('order.success');
}
    public function index()
    {
        $orders = Order::all();
        return view('backend.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('backend.orders.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('backend.orders.index')->with('success', 'Đơn hàng đã được xóa thành công!');
    }

    public function confirm($id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);
        
        // Cập nhật trạng thái của đơn hàng thành 'đã xác nhận'
        $order->status = 'đã xác nhận';
        $order->save();
        
        // Redirect về trang danh sách đơn hàng với thông báo thành công
        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được xác nhận thành công!');
    }

    public function showSuccess()
    {
        return view('backend.orders.index');
    }
   
}
