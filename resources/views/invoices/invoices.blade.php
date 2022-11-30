@extends('layouts.master')
@section('title')
قائمه الفواتير
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet" />


<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')


@if (session()->has('deleteInvoices'))
<script>
	window.onload = function() {
		notif({
			msg: 'تم الحذف بنجااااااااااح',
			type: "success"
		})
	}
</script>
@endif

@if (session()->has('archiveInvoices'))
<script>
	window.onload = function() {
		notif({
			msg: 'تم الارشفه بنجاح  ',
			type: "success"
		})
	}
</script>
@endif

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير</span>
		</div>
	</div>


</div>

<a class="btn btn-info" href="invoices/create"> انشاء فاتوره</a>
<!-- row opened -->
<div class="row row-sm">


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
								<th class="border-bottom-0">رقم الفاتوره</th>
								<th class="border-bottom-0">تاريخ الفاتوره</th>
								<th class="border-bottom-0">تاريخ الاستحقاق</th>
								<th class="border-bottom-0">القسم</th>
								<th class="border-bottom-0">المنتج</th>

								<th class="border-bottom-0">الخصم</th>
								<th class="border-bottom-0">نسبه الضريبه</th>
								<th class="border-bottom-0">قيمة الضريبه</th>
								<th class="border-bottom-0"> الاجمالي</th>
								<th class="border-bottom-0"> الحاله</th>
								<th class="border-bottom-0">ملاحظات</th>
								<th class="border-bottom-0">العمليات</th>

							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							@foreach($invoices as $invoice)
							<tr>
								<td>{{$i}}</td>
								<td>
									<a href="{{url('invoicesDetails')}}/{{$invoice->id}}">

										{{$invoice->invoice_number}}</a>
								</td>
								<td>{{$invoice->invoice_date}}</td>
								<td>{{$invoice->due_date}}</td>
								<td>{{$invoice->section->section_name}}</td>
								<td>{{$invoice->product}}</td>
								<td>{{$invoice->discount}}</td>
								<td>{{$invoice->rate_vat}}</td>
								<td>{{$invoice->value_vat}}</td>
								<td>{{$invoice->total}}</td>
								<td>
									@if($invoice->value_status==1)
									<span class="text-success">{{$invoice->status}}</span>
									@elseif($invoice->value_status==2)
									<span class="text-danger">{{$invoice->status}}</span>
									@else
									<span class="text-warning">{{$invoice->status}}</span>
									@endif

								</td>
								<td>{{$invoice->note}}</td>




								<td>

									<div class="dropdown">
										<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
										<div class="dropdown-menu tx-13">

											<a class="dropdown-item" href="">
												<i class="text-info fas fa-exchange-alt"></i>&nbsp;&nbsp;تعديل الفاتورة</a>


											<a class="dropdown-item" href="" data-invoice-id="{{ $invoice->id }}" data-toggle="modal" data-target="#delete">
												<i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذفالفاتورة
											</a>


											<a class="dropdown-item" href="{{url('invoicesPayment')}}/{{$invoice->id}}" >
												<i class=" text-success fa-money-bill"></i>&nbsp;&nbsp;تغير حالة الدفع
											</a>


											<a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}" data-toggle="modal" data-target="#Transfer_invoice">
												<i class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي الارشيف
											</a>



											<a class="dropdown-item" href="printInvoices/{{$invoice->id}}" ><i class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
												الفاتورة
											</a>

										</div>
									</div>


								</td>

							</tr>
							<?php $i++; ?>
							@endforeach




						</tbody>
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
</div>



<!--start delete modal -->
<div class="modal" id="delete">

	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title"> المرفقات</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">
				<div class="row">

					<form method="post" action="invoices">
						{{csrf_field()}}
						{{method_field('delete')}}
						<div class="form-group">

							<span>هل انت متاكد من حذف المرفق؟</span>

							<input type="text" name="id" id="id">
							<input type="text" name="type"  value="1">


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

<!--End delete modal -->


<!--start transfer invoices modal -->
<div class="modal" id="Transfer_invoice">

	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title"> الارشفه</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">
				<div class="row">

					<form method="post" action="invoices">
						{{csrf_field()}}
						{{method_field('delete')}}
						<div class="form-group">

							<span>هل انت متاكد من ارشفه الفاتوره؟</span>

							<input type="text" name="id" id="id">
							<input type="text" name="type"  value="2">


						</div>

				</div>
			</div>


			<div class="modal-footer">
				<button class="btn ripple btn-primary" type="submit">تاكيد</button>
				<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
			</div>

			</form>

		</div>
	</div>
</div>

<!--End transfer invoices modal -->



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
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->

<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>


<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<script>
	$('#delete').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)

		var id = button.data('invoice-id')

		var modal = $(this)

		modal.find('.modal-body #id').val(id);
	});
</script>


<script>
	$('#Transfer_invoice').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)

		var id = button.data('invoice_id')

		var modal = $(this)

		modal.find('.modal-body #id').val(id);
	});
</script>


@endsection