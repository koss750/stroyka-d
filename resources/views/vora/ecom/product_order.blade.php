@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<!-- Add Order -->
	<div class="modal fade" id="addOrderModalside">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create Project</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						@csrf
						<div class="form-group">
							<label class="text-black font-w500">Project Name</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Deadline</label>
							<input type="date" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Name</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary">CREATE</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/orders">Заказы</a></li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-sm table-responsive-lg mb-0 text-black">
							<thead>
								<tr>
									<th class="align-middle">
										<div class="custom-control custom-checkbox ms-1">
											<input type="checkbox" class="form-check-input" id="checkAll">
											<label class="custom-control-label" for="checkAll"></label>
										</div>
									</th>
									<th class="align-middle">Order</th>
									<th class="align-middle pe-7">Date</th>
									<th class="align-middle minw200">Ship To</th>
									<th class="align-middle text-end">Status</th>
									<th class="align-middle text-end">Amount</th>
									<th class="no-sort"></th>
								</tr>
							</thead>
							<tbody id="orders">
								<tr class="btn-reveal-trigger">
									<td class="py-2">
										<div class="custom-control custom-checkbox checkbox-success">
											<input type="checkbox" class="form-check-input" id="checkbox">
											<label class="custom-control-label" for="checkbox"></label>
										</div>
									</td>
									<td class="py-2">
										<a href="#">
											<strong>#181</strong></a> by <strong>Проект 220</strong> Смета <br /></td>
									<td class="py-2">20/04/2020</td>
									<td class="py-2">Электронная доставка
										<p class="mb-0 text-500">customer@email.com</p>
									</td>
									<td class="py-2 text-end"><span class="badge badge-success">Готово<span
												class="ms-1 fa fa-check"></span></span>
									</td>
									<td class="py-2 text-end">249 руб.
									</td>
									<td class="py-2 text-end">
										<div class="dropdown text-sans-serif">
										<svg width="90" height="90">       
     <image xlink:href="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" src="yourfallback.png" width="90" height="90"/>    
</svg>
											<div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="order-dropdown-0">
												<div class="py-2"><a class="dropdown-item" href="#!">Скачать</a><a class="dropdown-item" href="#!">Processing</a><a class="dropdown-item" href="#!">On Hold</a><a class="dropdown-item" href="#!">Pending</a>
													<div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Delete</a>
												</div>
											</div>
										</div>
									</td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection