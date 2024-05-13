<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Userfe;
use App\Models\Baner;


class RegisterController extends Controller
    {
        public function showRegistrationForm()
        {
            $data['banners'] = Baner::all();
            return view('frontend.register',$data);
        }


        public function registerfe(Request $request)
        {
            // Xác minh dữ liệu đầu vào từ biểu mẫu đăng ký
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
    
            // Tạo một bản ghi mới trong cơ sở dữ liệu để đăng ký người dùng
            $userfe = new Userfe();
            $userfe->name = $validatedData['name'];
            $userfe->email = $validatedData['email'];
            $userfe->password = Hash::make($validatedData['password']);
            $userfe->save();
    
            // Thực hiện hành động sau khi đăng ký thành công, ví dụ: chuyển hướng người dùng đến trang chính
            return redirect()->route('loginfe')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.');
        }
    }
