<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userfe;
use App\Models\Baner;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
      /**
     * Hiển thị form đăng nhập.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        $data['banners'] = Baner::all();
        return view('frontend.login',$data);
    }

    /**
     * Xử lý đăng nhập người dùng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginfe(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Thực hiện đăng nhập
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Nếu đăng nhập thành công, chuyển hướng về trang chính hoặc trang mong muốn
            return redirect()->intended('/');
        }

        // Nếu không đăng nhập thành công, chuyển hướng trở lại form đăng nhập với thông báo lỗi
        return redirect()->route('loginfe')->with('error', 'Đăng nhập thất bại. Vui lòng kiểm tra lại email và mật khẩu.');
    }

    /**
     * Hiển thị form đăng ký.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $data['banners'] = Baner::all();
        return view('frontend.register',$data);
    }

    /**
     * Xử lý đăng ký người dùng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:usersfe,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Tạo mới người dùng
        Userfe::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Chuyển hướng người dùng đến trang đăng nhập với thông báo thành công
        return redirect()->route('loginfe')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập để tiếp tục.');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        // Sau khi đăng xuất, bạn có thể chuyển hướng người dùng đến trang cụ thể hoặc trang chính
        return redirect()->route('frontend.home')->with('status', 'Bạn đã đăng xuất thành công.');
    }
}
