@extends('layouts.master')
@section('title')
قائمه الفواتير
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير</span>
		</div>
	</div>


</div>
<!-- row opened -->


@if(session()->has('update'))
<div class="alert alert-success " role="alert">
	<strong>{{session()->get('update')}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif


@if(session()->has('delete'))
<div class="alert alert-success " role="alert">
	<strong>{{session()->get('delete')}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

@if($errors->any() )
<div class="alert alert-danger  ">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error}}</li>
	</ul>

	@endforeach
</div>
@endif

<div class="row row-sm">

	<div class="d-flex">


		<a class="btn  btn-success" data-target="#modal1" data-toggle="modal" href=""> اضافه منتج</a>

	</div>



	<div class="modal" id="modal1">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content modal-content-demo">
				<div class="modal-header">
					<h6 class="modal-title"> المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body">
					<div class="row">

						<form method="POST" action="{{url('products')}}">
							{{csrf_field()}}
							<div class="form-group">

								<div class="col-md-6 m-10">
									<label for="اسم القسم"> اسم المنتج</label>
									<input type="text" name="product_name">
								</div>

								<div class="col-md-6 m-10">
									<label for="اسم القسم"> القسم</label>
									<select name="section_id" id="section_id" require>
										<option selected disabled>حدد القسم</option>
										@foreach($sections as $section)

										<option value="{{$section->id}}">{{$section->section_name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 mb-10">
									<label for="ملاحظات">ملاحظات</label>
									<textarea name="notes"></textarea>
								</div>
							</div>

					</div>
				</div>


				<div class="modal-footer">
					<button class="btn ripple btn-primary" type="submit">انشاء</button>
					<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
				</div>

				</form>

			</div>
		</div>
	</div>
	<!--End Grid modal -->




	<!--div-->

	<!--div-->
	<div class="col-xl-12">
		<div class="card mg-b-20">

			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0">#</th>
								<th class="border-bottom-0">اسم المنتج </th>
								<th class="border-bottom-0">اسم القسم </th>
								<th class="border-bottom-0"> ملاحظات</th>
								<th class="border-bottom-0">العمليات</th>

							</tr>
						</thead>
						<?php $i = 1; ?>
						@foreach($products as $product)
						<tr>

							<td>{{$i}}</td>
							<td>{{$product->product_name}} </td>
							<td>{{$product->section->section_name}}</td>
							<td>{{$product->description}}</td>
							<td>
								<a class="btn  btn-info" data-target="#modal2" 
								data-id="{{$product->id}}" 
								data-product_name="{{$product->product_name}}" 
								data-section_name="{{$product->section->section_name}}"
								data-description="{{$product->description}}" 
								data-toggle="modal" href=""> تعديل</a>

								<a class="btn  btn-danger" data-target="#modal3" 
								data-id="{{$product->id}}" 
								data-product_name="{{$product->product_name}}" 
								data-section_name="{{$product->section->section_name}}"
								data-description="{{$product->description}}" 
								data-toggle="modal" href=""> حذف</a>							</td>
							<?php $i++; ?>

						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--/div-->


</div>
<!-- /row -->
</div>
<!-- Container closed -->


	<!--start edit modal -->
<div class="modal" id="modal2">

		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content modal-content-demo">
				<div class="modal-header">
					<h6 class="modal-title"> المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body">
					<div class="row">

						<form method="POST" action="{{url('products')}}">
							{{csrf_field()}}
							{{method_field('put')}}
							<div class="form-group">
							<input type="text" name="product_id" id="product_id">

								<div class="col-md-6 m-10">
									<label for="اسم القسم"> اسم المنتج</label>
									<input type="text" name="product_name" id="product_name">
								</div>

								<div class="col-md-6 m-10">
									<label for="اسم القسم"> القسم</label>
									<select name="section_name" >

										@foreach($sections as $section)
										<option  >{{$section->section_name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 mb-10">
									<label for="ملاحظات">ملاحظات</label>
									<textarea name="notes" id="notes"></textarea>
								</div>
							</div>

					</div>
				</div>


				<div class="modal-footer">
					<button class="btn ripple btn-primary" type="submit">تعديل</button>
					<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
				</div>

				</form>

			</div>
		</div>
	</div>

	<!--End edit modal -->


		<!--start delete modal -->
<div class="modal" id="modal3">

<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content modal-content-demo">
		<div class="modal-header">
			<h6 class="modal-title"> المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
		</div>

		<div class="modal-body">
			<div class="row">

				<form method="POST" action="{{url('products')}}">
					{{csrf_field()}}
					{{method_field('delete')}}
					<div class="form-group">

					<input type="text" name="product_id" id="product_id">

					<span>هل تريد حذف هذا المنتج</span>


						<div class="col-md-6 m-10">
							<input type="text" name="product_name" id="product_name">
						</div>
				
					</div>

				
			</div>
		</div>


		<div class="modal-footer">
			<button class="btn ripple btn-primary" type="submit">حذف</button>
			<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
		</div>

		</form>

	</div>
</div>
</div>

<!--End delete modal -->

</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>

<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>




<script>
$('#modal2').on('show.bs.modal', function(event){
	var button= $(event.relatedTarget)

	var product_id=button.data('id')
	var product_name=button.data('product_name')
	var section_name=button.data('section_name')
	var description=button.data('description')


	var modal=$(this)

	modal.find('.modal-body #product_id').val(product_id);
	modal.find('.modal-body #product_name').val(product_name);
	modal.find('.modal-body #section_name').val(section_name);
	modal.find('.modal-body #notes').val(description);
});

</script>




<script>
$('#modal3').on('show.bs.modal', function(event){
	var button= $(event.relatedTarget)

	var product_id=button.data('id')
	var product_name=button.data('product_name')
	var section_name=button.data('section_name')
	var description=button.data('description')


	var modal=$(this)

	modal.find('.modal-body #product_id').val(product_id);
	modal.find('.modal-body #product_name').val(product_name);
	modal.find('.modal-body #section_name').val(section_name);
	modal.find('.modal-body #notes').val(description);
});

</script>
@endsection