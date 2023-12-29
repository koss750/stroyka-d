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
	<div class="d-md-flex d-block mb-3 pb-3 border-bottom">
		<div class="card-action card-tabs mb-md-0 mb-3  me-auto">
			<ul class="nav nav-tabs tabs-lg">
				<li class="nav-item">
					<a href="#navpills-1" class="nav-link active" data-bs-toggle="tab" aria-expanded="false"><span class="badge light badge-primary">851</span>All Contacs</a>
				</li>
				<li class="nav-item">
					<a href="#navpills-2" class="nav-link" data-bs-toggle="tab" aria-expanded="false"><span class="badge light badge-primary">62</span>Pending Invitation</a>
				</li>	
			</ul>
		</div>
		<div>
			<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addOrderModal"  class="btn btn-primary rounded"><i class="fa fa-user me-2 scale5" aria-hidden="true"></i>+ New Contact</a>
			<!-- Add Order -->
			<div class="modal fade" id="addOrderModal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Contact</h5>
							<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								@csrf
								<div class="form-group">
									<label class="text-black font-w500">First Name</label>
									<input type="text" class="form-control">
								</div>
								<div class="form-group">
									<label class="text-black font-w500">Last Name</label>
									<input type="text" class="form-control">
								</div>
								<div class="form-group">
									<label class="text-black font-w500">Address</label>
									<input type="text" class="form-control">
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-primary">SAVE</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-9 col-xxl-8 col-lg-8">
			<div class="tab-content">
				<div class="tab-pane fade show active" id="navpills-1" role="tabpanel">
					<div class="row loadmore-content" id="RecentActivitiesContent">
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/13.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Abdul Kean</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/14.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Angela </a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/15.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Afiff </a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/16.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Abigail</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/17.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Bella Syuqr</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/18.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Benny Gac</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/19.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black"> Simatup..</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/20.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Denny Jin</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/21.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Franklin CS</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/22.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Fanny Sara</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/23.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Hermanto</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/24.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Lulu Salam</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-12 mb-4 text-center">
							<a href="javascript:void(0)" class="btn btn-outline-primary mx-auto dlab-load-more"  rel="{{ url('ajax/contacts')}}" id="RecentActivities">Load More</a>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="navpills-2" role="tabpanel">
					<div class="row loadmore-content" id="RecentActivities2Content">
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx ">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/15.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Abdul Kean</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/13.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Angela Moss</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/17.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Afiff Skunder</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/19.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Abigail Smurt</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/17.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Bella Syuqr</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/18.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Benny Gacu</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/19.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Simatup..</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/20.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Denny Juan</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/21.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Franklin CS</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/22.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Fanny Sara</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/23.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Hermanto</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3">
											<img src="{{ asset('images/users/24.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Lulu Salam</a></h6>
											<p class="fs-14">Highspeed Inc.</p>
											<ul>
												<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
												<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-12 mb-4 text-center">
							<a href="javascript:void(0)" class="btn btn-outline-primary mx-auto dlab-load-more"  rel="{{ url('ajax/contacts')}}" id="RecentActivities2">Load More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-xxl-4 col-lg-4">
			<div class="row">
				<div class="col-xl-12">
					<div class="card profile-card">
						<div class="card-body pb-0 text-center">
							<div class="image-bx mb-3">
								<img src="{{ asset('images/users/25.jpg')}}" alt="" width="120" class="rounded-circle">
								<span class="active"></span>
							</div>
							<h4 class="fs-20 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Angela </a></h4>
							<p class="fs-14">Highspeed Inc.</p>
							<ul>
								<li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
								<li><a href="javascript:void(0)"><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
								<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
							</ul>
							<div class="row">
								<div class="col-6">
									<a href="{{ url('app-profile')}}" class="btn btn-sm btn-outline-primary rounded d-block">Edit</a>
								</div>
								<div class="col-6">
									<a href="{{ url('app-profile')}}" class="btn btn-sm btn-outline-dark rounded d-block">Remove</a>
								</div>
							</div>
						</div>
						<div class="card-body">
							<h6 class="fs-16 text-black font-w600">About</h6>
							<p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection