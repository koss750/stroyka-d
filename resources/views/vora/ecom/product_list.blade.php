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
	
	<div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Layout</a></li>
			<li class="breadcrumb-item active"><a href="javascript:void(0)">Blank</a></li>
		</ol>
	</div>
	<div class="row">

	@foreach ($designs as $design)
    <div class="col-xl-4 col-lg-6 col-md-12">
        <div class="card">
            <!-- Card Image -->
            <div class="card-image">
                <img class="img-fluid" src="{{ asset($design->image_url)}}" alt="">
                <!-- Title Overlay -->
                <div class="card-title-overlay">
                    <h2 class="main-title">Дома из бруса</h2>
                </div>
            </div>

            <!-- Card Details Overlay -->
            <div class="card-details-overlay">
                <span class="model-name">{{ $design->title }}</span>
                <span class="dimensions-area-container">
                    <span class="dimensions">{{ $design->dimensions }}</span> m<sup class="sup-text">2</sup>
                </span>
                <span class="price">от {{ $designs[0]->price }}₽</span>
            </div>
        </div>
    </div>
@endforeach

</div>
		<!-- review -->
		<div class="modal fade" id="reviewModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Review</h5>
						<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							@csrf
							<div class="text-center mb-4">
								<img class="img-fluid rounded" width="78" src="{{ asset('images/avatar/1.jpg')}}" alt="DexignLab">
							</div>
							<div class="form-group">
								<div class="rating-widget mb-4 text-center">
									<!-- Rating Stars Box -->
									<div class="rating-stars">
										<ul id="stars">
											<li class="star" title="Poor" data-value="1">
												<i class="fa fa-star fa-fw"></i>
											</li>
											<li class="star" title="Fair" data-value="2">
												<i class="fa fa-star fa-fw"></i>
											</li>
											<li class="star" title="Good" data-value="3">
												<i class="fa fa-star fa-fw"></i>
											</li>
											<li class="star" title="Excellent" data-value="4">
												<i class="fa fa-star fa-fw"></i>
											</li>
											<li class="star" title="WOW!!!" data-value="5">
												<i class="fa fa-star fa-fw"></i>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="form-group">
								<textarea class="form-control" placeholder="Comment" rows="5"></textarea>
							</div>
							<button class="btn btn-success btn-block">RATE</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection