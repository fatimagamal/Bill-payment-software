@extends('layouts.master')
@section('title')
الاقسام
@stop
@section('css')
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

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
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
						</div>
					</div>
				
					</div>
			
				<!-- breadcrumb -->
@endsection
@section('content')

<div class="d-flex">
					
						
					<a class="btn  btn-success" data-target="#modaldemo4" data-toggle="modal" href="">انشاء قسم</a>
									
</div>

<!-- session message -->

@if(session()->has('delete'))
<div class="alert alert-success " role="alert">
	<strong>{{session()->get('delete')}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<!-- session message -->
<!-- 
@if(session()->has('add'))
<div class="alert alert-success " role="alert">
	<strong>{{session()->get('add')}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger " role="alert">
	<strong>{{session()->get('error')}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif -->

<!-- Grid modal -->



								@if($errors->any() )
								<div class="alert alert-danger  ">
									<ul>
										@foreach($errors->all() as $error)
										<li>{{ $error}}</li>
									</ul>
								
                                   @endforeach
								   </div>
								   @endif
								
							
							<div class="card-body">
								<div >
									<table id="example" class="table key-buttons text-sm">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم القسم </th>
												<th class="border-bottom-0">ملاحظات</th>
												<th class="border-bottom-0">اسم العامل </th>

											</tr>
										</thead>
										@if(isset($getSectionById))
										<tbody>
											<tr>
											<td>{{$getSectionById->section_name}}</td>
											<td>{{$getSectionById->description}}</td>
											<td>{{$getSectionById->created_by}}</td>
											<td>
											<a class="btn  btn-info" data-target="#modaldemo6" data-id="{{$getSectionById->id}}" data-section_name="{{$getSectionById->section_name}}"  data-toggle="modal" href=""> تعديل</a>
											<a class="btn  btn-danger" data-target="#modaldemo5" data-id="{{$getSectionById->id}}" data-section_name="{{$getSectionById->section_name}}" data-toggle="modal" href=""> حذف</a>
										    </td>
											</tr>
										</tbody>
										

										@else
										<tbody>
                                       <?php     $id=1;?>

											@foreach($sections as $section )
											<tr>
											<td>{{$id}} </td>
											<td>{{$section->section_name}}</td>
											<td>{{$section->description}}</td>
											<td>{{$section->created_by}}</td>
											<td>
											<a class="btn  btn-info" data-target="#modaldemo6" data-id="{{$section->id}}" data-section_name="{{$section->section_name}}"  data-toggle="modal" href=""> تعديل</a>
											<a class="btn  btn-danger" data-target="#modaldemo5" data-id="{{$section->id}}" data-section_name="{{$section->section_name}}" data-toggle="modal" href=""> حذف</a>
										    </td>

											</tr>
											<?php   $id++;?>
											
										   @endforeach


										</tbody>
										@endif
									</table>
								</div>
							</div>
					</div>
			
					<!--/div-->
					
<!-- Grid modal -->
<div class="modal" id="modaldemo4">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">انشاء قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>

					<div class="modal-body">
						<div class="row">

						<form  method="POST"  action="{{url('sections')}}">
							{{csrf_field()}}
							<div class="form-group">
							<div class="col-md-6 m-10">
								<label for="اسم القسم">اسم القسم</label>
								<input type="text"  name="section_name" >
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


<!-- Grid modal delete -->
<div class="modal" id="modaldemo5">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title"> حذف القسم </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>

					<div class="modal-body">
						<div class="row">

						<form  method="POST"  action="{{url('sections')}}">
						{{method_field('delete')}}
							{{csrf_field()}}
							<div class="form-group">
							<div class="col-md-6 m-10">
								<p >هل تريد حذف هذا القسم</p>
								<input  type="text" name="id" id="id" value=""></input>
								<input type="text"  name="section_name" id="section_name" value="" ></input>
							</div>
							</div>

						</div>
					</div>


					<div class="modal-footer">
						<button class="btn ripple btn-primary" type="submit">حذف</button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
					</div>

					</form>

				</div>
			</div>
		</div>
		<!--End Grid modal delete-->




		

<!-- Grid modal update -->
<div class="modal" id="modaldemo6">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title"> تعديل القسم </h6>
						<button aria-label="Close" class="close" data-dismiss="modal" type="button">
							<span aria-hidden="true">&times;</span></button>
					</div>

					<div class="modal-body">
						<div class="row">

						<form  method="POST"  action="{{url('sections')}}" autocomplete="off">
						{{method_field('put')}}
							{{csrf_field()}}
							<div class="form-group">
							<div class="col-md-6 m-10">
								<label for="اسم القسم">اسم القسم</label>
								<input type="text"  name="section_name"  id="section_name">
							</div>

							<input type="text"  name="id"  id="id" value="">

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
						<button class="btn ripple btn-primary" type="submit">تعديل</button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
					</div>

					</form>

				</div>
			</div>
		</div>
		<!--End Grid modal update-->
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
\
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>



<script>
	$('#modaldemo5').on('show.bs.modal',function(event)
	{
	var button=$(event.relatedTarget)
	var id=button.data('id')
	var name=button.data('section_name')

	var modal=$(this)
	modal.find('.modal-body #id').val(id)
	modal.find('.modal-body #section_name').val(name)
	}
	                 )
</script>

<script>
        $('#modaldemo6').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
        })
    </script>


@endsection