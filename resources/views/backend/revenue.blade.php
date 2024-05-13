@extends('backend.master')

@section('title', 'Quản lý Doanh thu')

@section('main')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Doanh thu</h1>
            </div>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Danh sách Doanh thu</div>
                    <div class="panel-body">
                        <form action="{{ route('backend.revenues.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="month">Tháng:</label>
                                    <select name="month" id="month" class="form-control">
                                        <option value="">Chọn tháng</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="year">Năm:</label>
                                    <select name="year" id="year" class="form-control">
                                        <option value="">Chọn năm</option>
                                        @for ($i = date('Y'); $i >= 2010; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Lọc</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="bootstrap-table">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="margin-top:20px;">               
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>Ngày</th>
                                            <th>Tổng doanh thu</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($revenues as $revenue)
                                        <tr>
                                            <td>{{ $revenue->id }}</td>
                                            <td>{{ $revenue->date }}</td>
                                            <td>{{ number_format($revenue->total, 2) }}</td>
                                            <td>
                                                <!-- Các thao tác khác như sửa, xóa, chi tiết, ... -->
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>                            
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>
@endsection
