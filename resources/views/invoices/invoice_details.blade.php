@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection

@section('content')
<!-- row opened -->


@if (session()->has('delete'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif




<div class="row row-sm">
	<div class="col-lg-12 col-md-12">
		<div class="card" id="basic-alert">
			<div class="card-body">
				<div class="col-xl-12">
					<!-- div -->
					<div class="card mg-b-20" id="tabs-style2">
						<div class="card-body">
							<div class="main-content-label mg-b-5">
								Basic Style2 Tabs
							</div>
							<div class="example">
								<div class="panel panel-primary tabs-style-2">
									<div class=" tab-menu-heading">
										<div class="tabs-menu1">
											<!-- Tabs -->
											<ul class="nav panel-tabs main-nav-line">
												<li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات عن الفاتوره</a></li>
												<li><a href="#tab5" class="nav-link" data-toggle="tab">حالات دفع الفاتوره</a></li>
												<li><a href="#tab6" class="nav-link" data-toggle="tab">مرفقات الفاتوره</a></li>
											</ul>
										</div>
									</div>
									<div class="panel-body tabs-menu-body main-content-body-right border">
										<div class="tab-content">


											<!-- //////////////////////////////////////////////////////////////////// -->
											<div class="tab-pane active" id="tab4">
												<div class="col-xl-12">
													<div class="card mg-b-20">

														<div class="card-body">
															<div class="table-responsive">
																<table class="table table-striped  text-md-nowrap">
																	<thead>
																		<tr>
																			<th class="border-bottom-0">رقم الفاتوره</th>
																			<th>{{$invoice->invoice_number}}</th>

																			<th class="border-bottom-0">تاريخ الاصدار</th>
																			<th> {{$invoice->invoice_date}}</th>


																			<th class="border-bottom-0">تاريخ الاستحقاق</th>
																			<th>{{$invoice->due_date}}</th>


																			<th class="border-bottom-0">القسم</th>
																			<th>{{$invoice->section->section_name}}</th>


																			<th class="border-bottom-0">المنتج</th>
																			<th>{{$invoice->product}}</th>

																			<th class="border-bottom-0">مبلغ التحصيل</th>
																			<th>{{$invoice->amount_collection}}</th>
																		</tr>
																		<tr>

																			<th class="border-bottom-0">مبلغ العموله</th>
																			<th>{{$invoice->amount_commission}}</th>


																			<th class="border-bottom-0">الخصم</th>
																			<th>{{$invoice->discount}}</th>


																			<th class="border-bottom-0">نسبه الضريبه</th>
																			<th>{{$invoice->rate_vat}}</th>

																			<th class="border-bottom-0">قيمة الضريبه</th>
																			<th>{{$invoice->value_vat}}</th>


																			<th class="border-bottom-0"> الاجمالي مع الضريبه</th>
																			<th>{{$invoice->total}}</th>


																			<th class="border-bottom-0"> الحاليه الحاله</th>
																			<th>
																				@if($invoice->value_status==1)
																				<span class="text-success">{{$invoice->status}}</span>
																				@elseif($invoice->value_status==2)
																				<span class="text-danger">{{$invoice->status}}</span>
																				@else
																				<span class="text-warning">{{$invoice->status}}</span>
																				@endif

																			</th>

																			<th class="border-bottom-0">ملاحظات</th>
																			<th>{{$invoice->note}}</th>



																		</tr>
																	</thead>
																</table>
															</div>
														</div>
													</div>
												</div>

											</div>
											<!-- ////////////////////////////////////////////////////////////////////////////// -->



											<!-- ///////////////////////////////////////////////////////////////// -->
											<div class="tab-pane" id="tab5">
												<div class="table-responsive">
													<table id="example" class="table key-buttons text-md-nowrap">
														<thead>
															<tr>
																<th class="border-bottom-0">#</th>
																<th class="border-bottom-0">رقم الفاتوره</th>
																<th class="border-bottom-0"> نوع المنتج</th>

																<th class="border-bottom-0">القسم</th>
																<th class="border-bottom-0">حاله الدفع</th>
																<th class="border-bottom-0">تاريخ الدفع</th>
																<th class="border-bottom-0">ملاحظات</th>
																<th class="border-bottom-0">تاريخ الاضافه</th>
																<th class="border-bottom-0">المستخدم</th>

															</tr>
														</thead>
														<tbody>
															<?php $i = 1; ?>
															@foreach($invoices_details as $invoice_details)
															<tr>
																<td>{{$i}}</td>
																<td>{{$invoice_details->id_invoice}}</td>

																<td>{{$invoice_details->product}}</td>
																<td>{{$invoice_details->section->section_name}}</td>
																<td>
																	@if($invoice_details->value_status==1)
																	<span class="text-success">{{$invoice_details->status}}</span>
																	@elseif($invoice_details->value_status==2)
																	<span class="text-danger">{{$invoice_details->status}}</span>
																	@else
																	<span class="text-warning">{{$invoice_details->status}}</span>
																	@endif

																</td>
																<td> {{$invoice_details->payment_date}}</td>
																<td>{{$invoice_details->note}}</td>
																<td>{{$invoice_details->created_at}}</td>
																<td>{{$invoice_details->user}}</td>
															</tr>
															<?php $i++; ?>
															@endforeach



														</tbody>
													</table>
												</div>
											</div>






											<!-- /////////////////////////////////// -->


											<div class="tab-pane" id="tab6">
												<div class="table-responsive">
													  <!--المرفقات-->

													  <div class="card card-statistics">
                                                    <div class="card-body">

                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>

                                                        <form method="post" action="{{url('storeAtachements')}}" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"  name="file_name" required>
																<input type="hidden" name="invoice_number" value="{{$invoice->invoice_number}}">
																<input type="hidden" name="invoice_id" value="{{$invoice->id}}">
																<label class="custom-file-label" for="customFile">حددالمرفق</label>
                                                            </div>
															<br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm " >تاكيد</button>
                                                        </form>
                                                    </div>
                                                <br>

												<!-- انهاء المرفقات -->
													<table id="example" class="table key-buttons text-md-nowrap" style="text-align:center ;">
														<thead>
															<tr>
																<th class="border-bottom-0">#</th>
																<th class="border-bottom-0"> اسم الملف</th>
																<th class="border-bottom-0"> قام بالاضافه </th>

																<th class="border-bottom-0">تاريخ الاضافه </th>
																<th class="border-bottom-0">العمليات</th>
															</tr>
														</thead>

														<tbody>
															<?php $i = 1; ?>
															@foreach($invoice_attachements as $invoice_attachement)
															<tr>
																<td>{{$i}}</td>

																<td>{{$invoice_attachement->file_name}}</td>

																<td>{{$invoice_attachement->Created_by}}</td>
																<td>{{$invoice_attachement->created_at}}</td>
																<td>
																	<a class="btn btn-success" href="{{url('showFile')}}/{{$invoice_attachement->invoice_number}}/{{$invoice_attachement->file_name}}">عرض</a>
																	<a class="btn btn-info" href="{{url('downloadFile')}}/{{$invoice_attachement->invoice_number}}/{{$invoice_attachement->file_name}}">تحميل</a>
																	
																	<button class="btn btn-danger" 
																	data-target="#modal"
																	data-id="{{$invoice_attachement->id}}" 
																	data-invoice_number="{{$invoice_attachement->invoice_number}}" 
																	data-file_name="{{$invoice_attachement->file_name}}" 
																	data-toggle="modal">حذف</button>
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
								</div>
							</div>


							<!--start edit modal -->
<div class="modal" id="modal">

<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content modal-content-demo">
		<div class="modal-header">
			<h6 class="modal-title"> المرفقات</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
		</div>

		<div class="modal-body">
			<div class="row">

				<form method="post" action="{{url('invoicesAttachement')}}">
					{{csrf_field()}}
					{{method_field('delete')}}
					<div class="form-group">

                    <span>هل انت متاكد من حذف المرفق؟</span>

					<input type="text" name="id" id="id">

					<input type="text" name="invoice_number" id="invoice_number">

					<input type="text" name="file_name" id="file_name">
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

<!--End edit modal -->





							<!-- //////////////////////////////////////////////////////////////////////////////////// -->
							@endsection


							@section('js')
							
<script>
$('#modal').on('show.bs.modal', function(event){
	var button= $(event.relatedTarget)

	var id=button.data('id')
	var invoice_number=button.data('invoice_number')
	var file_name=button.data('file_name')


	var modal=$(this)

	modal.find('.modal-body #id').val(id);
	modal.find('.modal-body #invoice_number').val(invoice_number);
	modal.find('.modal-body #file_name').val(file_name);
});

</script>
							<!--Internal  Datepicker js -->
							<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
							<!-- Internal Select2 js-->
							<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
							<!-- Internal Jquery.mCustomScrollbar js-->
							<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
							<!-- Internal Input tags js-->
							<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
							<!--- Tabs JS-->
							<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
							<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
							<!--Internal  Clipboard js-->
							<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
							<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
							<!-- Internal Prism js-->
							<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
							@endsection