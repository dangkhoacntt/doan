<?php

namespace App\Http\Controllers;
use App\Models\Baner;
use Illuminate\Http\Request;

class BanerController extends Controller
{
    public function index()
    {
        $baners = Baner::all();
        return view('backend.baner', ['baners' => $baners]);
    }
    public function edit($id)
{
    $baner = Baner::find($id);
    return view('backend.editbaner', compact('baner'));
}



public function update(Request $request, $id)
{
    $baner = Baner::find($id);
    if ($request->hasFile('baner_image')) {
        $file = $request->file('baner_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path_upload = 'baner1/';
        $file->move($path_upload, $filename);
        $baner->baner = $path_upload . $filename;
    }

    // Kiểm tra và cập nhật link nếu được cung cấp
    if ($request->has('link')) {
        $baner->link = $request->input('link');
    }

    $baner->save();

    return redirect()->route('homebaner')->with('success', 'Thông tin baner đã được cập nhật thành công.');
}

}

