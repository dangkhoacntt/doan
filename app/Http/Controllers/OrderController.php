<?php

namespace App\Http\Controllers;
use App\Models\OrderDetail;
use App\Models\Revenue;
use App\Models\Order;
use Cart;
use App\Models\Product;
use App\Models\Baner;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function confirmOrder(Request $request)
    {
        // Lưu thông tin đơn hàng vào bảng orders
        $order = new Order();
        $order->email = $request->input('email');
        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->status = 'pending'; // Đã xác nhận đơn hàng
        $order->save();
        
        // Lấy thông tin sản phẩm trong giỏ hàng
        $items = Cart::content();

        // Lưu thông tin chi tiết đơn hàng và cập nhật số lượng sản phẩm
        foreach ($items as $item) {
            $product = Product::find($item->id);

            // Kiểm tra số lượng sản phẩm trong kho
            if ($product->prod_quantity == 0 || $product->prod_quantity < $item->qty) {
                // Số lượng sản phẩm không đủ, quay trở lại trang giỏ hàng với thông báo lỗi
                return redirect()->route('cart.show')->with('error', 'Sản phẩm "' . $product->prod_name . '" hiện đã hết hàng hoặc không đủ số lượng.');
            }

            // Lưu thông tin chi tiết đơn hàng
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_name = $item->name;
            $orderDetail->quantity = $item->qty;
            $orderDetail->price = $item->price;
            $orderDetail->save();

            // Cập nhật số lượng sản phẩm trong kho
            $product->prod_quantity -= $item->qty;
            $product->save();
        }

        // Tính tổng doanh thu từ đơn hàng
        $totalRevenue = $items->sum(function ($item) {
            return $item->qty * $item->price;
        });

        // Gọi phương thức để tạo hoặc cập nhật báo cáo
        $this->createReport($totalRevenue);

        // Xóa giỏ hàng sau khi đặt hàng thành công
        Cart::destroy();

        // Redirect đến trang thông báo đặt hàng thành công
        return redirect()->route('order.success');
    }

   
public function createReport($orderTotal)
{
    // Lấy ngày hiện tại
    $today = now()->format('Y-m-d');

    // Kiểm tra xem đã có báo cáo doanh thu cho ngày hiện tại chưa
    $report = Revenue::where('date', $today)->first();

    // Nếu đã có báo cáo, cập nhật tổng doanh thu
    if ($report) {
        $report->total += $orderTotal;
        $report->save();
    } else {
        // Nếu chưa có, tạo báo cáo mới
        $report = new Revenue();
        $report->date = $today;
        $report->total = $orderTotal;
        $report->save();
    }

    // Chuyển hướng đến trang quản lý đơn hàng và hiển thị thông báo
    return redirect()->route('admin.orders.index')->with('success', 'Đã cập nhật báo cáo doanh thu thành công.');
}
    public function showSuccess()
    {
        $data['banners'] = Baner::all();
        
        // Hiển thị trang thông báo đặt hàng thành công
        return view('frontend.complete',$data);
    }

}