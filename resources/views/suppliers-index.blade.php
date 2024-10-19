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
	@include('partials.supplier-type-filter')

	<div class="row">
		@forelse($suppliers as $supplier)
			<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
				<div class="card h-100">
					<div class="card-body">
						<div class="row">
							<div class="col-4 text-center">
								<img src="{{ $supplier->profile_picture_url ?? asset('images/profile/default.png') }}" class="img-fluid rounded-circle mb-3" alt="{{ $supplier->company_name }}">
								<div class="rating">
								@for ($i = 1; $i <= 5; $i++)
										<i class="fas fa-star {{ $i <= 4 ? 'text-warning' : 'text-muted' }}"></i>
									@endfor
								@if($supplier->yandex_maps_link)
								
								<a href="{{ $supplier->yandex_maps_link }}" target="_blank" class="ml-2 no-text-decoration" title="Посмотреть на Яндекс Картах">	
									
									<span class="ml-1">4.7</span>
									
										
											<i class="fas fa-map-marker-alt"></i>
										</a>
									@endif
								</div>
							</div>
							<div class="col-8">
								<h4 class="mb-1">{{ $supplier->company_name }}</h4>
								<p class="text-muted small mb-2">
									<i class="fas fa-check-circle text-success"></i> ИНН: {{ $supplier->inn ?? 'Не указан' }}
								</p>
								<p class="mb-1"><strong>Тип:</strong> {{ $supplier->type == 'contractor' ? 'Подрядчик' : 'Поставщик' }}</p>
								<p class="mb-1"><strong>Организация:</strong> {{ $supplier->type_of_organisation }}</p>
								<p class="mb-0"><strong>Регионы:</strong> {{ $supplier->regions->pluck('name')->implode(', ') }}</p>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-6">
								<a href="{{ route('supplier.profile', $supplier->id) }}" class="btn btn-primary btn-block">Профиль</a>
							</div>
							<div class="col-6">
								<a href="#" class="btn btn-outline-primary btn-block">Сообщение</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		@empty
			<div class="col-12">
				<p>На данный момент нет одобренных исполнителей.</p>
			</div>
		@endforelse
	</div>
</div>
@endsection

<style>
	.no-text-decoration {
		text-decoration: none;
	}
</style>
