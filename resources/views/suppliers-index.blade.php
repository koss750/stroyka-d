@extends('layouts.alternative')


@section('canonical', '')


@section('additional_head')

@endsection

@section('content')
<div class="container-fluid">
	@include('partials.tab-navigator', ['items' => [
			['url' => '/my-orders', 'label' => 'Заказы'],
			['url' => '/suppliers', 'label' => 'Исполнители'],
			['url' => '/messages', 'label' => 'Мои переписки'],
			['url' => '/profile', 'label' => 'Мои данные'],
		]])
	<div class="row">
		<div class="col-xl-9 col-xxl-8 col-lg-8">
			<div class="tab-content">
				<div class="tab-pane fade show active" id="navpills-1" role="tabpanel">
					<div class="row loadmore-content" id="RecentActivitiesContent">
						<!-- Замена имен на названия российских строительных компаний -->
						<div class="col-xl-4 col-xxl-6 col-sm-6">
							<div class="card contact-bx">	
								<div class="card-body">
									<div class="media">
										<div class="image-bx me-3 me-lg-2 me-xl-3 ">
											<img src="{{ asset('images/users/13.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">СтройМатериалы</a></h6>
											<p class="fs-14">ООО "СтройГрупп"</p>
											<ul>
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
											<img src="{{ asset('images/users/13.jpg')}}" alt="" class="rounded-circle" width="90">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<h6 class="fs-20 font-w600 mb-0"><a href="{{ url('app-profile')}}" class="text-black">Константин Б.</a></h6>
											<p class="fs-14">Borodin Services Ltd</p>
											<ul>
												<li><a href="{{ url('messages')}}"><i class="las la-sms"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Продолжение списка контактов с названиями компаний -->
					</div>
				</div>
				<div class="tab-pane fade" id="navpills-2" role="tabpanel">
					<div class="row loadmore-content" id="RecentActivities2Content">
						<!-- Контент ожидающих приглашений с измененными на российские строительные компании именами -->
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-xxl-4 col-lg-4">
			<!-- Боковая панель профиля -->
		</div>
	</div>
</div>
@endsection
