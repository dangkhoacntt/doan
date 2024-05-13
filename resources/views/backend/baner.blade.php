@extends('backend.master')	
	@section('main')
	@section('title','baner')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Baner</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				
				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách Baner</div>
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<table class="table table-bordered" style="margin-top:20px;">				
									<thead>
										<tr class="bg-primary">
											<th>ID</th>
											<th width="20%">Ảnh Baner</th>
											<th>Link</th>
											<th>Tùy chọn</th>
										</tr>
									</thead>
									<tbody>
									@foreach ($baners as $baner)	
										<tr>
											<td>{{ $baner->id }}</td>
                                            <td><img src="{{ asset($baner->baner) }}" alt="Baner Image"></td>
                                        	</td>
											<td>{{$baner->link}}</td>
											<td> <a href="{{ route('editbaner', ['id' => $baner->id]) }}">sửa </a></td>
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
 @stop